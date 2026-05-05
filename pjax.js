/**
 * @typedef {Object} Pjax
 * @property {jQuery} $mainContainer - jQuery reference to main container
 * @property {Array} cache - Cached pages for faster navigation
 * @description Client-side pjax implementation for handling SPA navigation and partial page loads
 */

const pjax = {
  /** @type {jQuery} jQuery reference to main container */
  $mainContainer: null,
  cacheEnabled: true,
  cacheStorage: {},
  maxCacheKeys: 100, // Maximum number of pages to cache to prevent memory leaks
  onPageLoaded: function (url) { },
  onLinkClick: function (target) { },

  /**
   * Encode a key to Base64 format safely (supports Unicode).
   */
  encodeCacheKey(key) {
    const baseHref = $("base").attr("href") || "";
    const normalizedKey = key.replace(baseHref, "");
    return btoa(encodeURIComponent(normalizedKey));
  },

  /**
   * Save string value in cache
   */
  setCache(key, value) {
    if (!this.cacheEnabled) return false;
    const encodedKey = this.encodeCacheKey(key);

    // Simple cleanup to prevent unbounded memory growth
    const keys = Object.keys(this.cacheStorage);
    if (keys.length >= this.maxCacheKeys) {
      delete this.cacheStorage[keys[0]]; // Remove oldest cache entry
    }

    this.cacheStorage[`cache_${encodedKey}`] = value;
  },

  /**
   * Save JSON data in cache
   */
  setCacheData(key, data) {
    if (!this.cacheEnabled) return false;
    this.setCache(key, JSON.stringify(data));
  },

  /**
   * Retrieve string data from cache
   */
  getCache(key) {
    if (!this.cacheEnabled) return false;
    return this.cacheStorage[`cache_${this.encodeCacheKey(key)}`] || null;
  },

  /**
   * Retrieve JSON data from cache
   */
  getCacheData(key) {
    if (!this.cacheEnabled) return false;
    const cachedData = this.getCache(key);
    try {
      return cachedData ? JSON.parse(cachedData) : null;
    } catch (e) {
      return null;
    }
  },

  /**
   * Remove specific item from cache
   */
  removeCache(key) {
    if (!this.cacheEnabled) return false;
    delete this.cacheStorage[`cache_${this.encodeCacheKey(key)}`];
  },

  /**
   * Clear all cached data
   */
  clearCache() {
    this.cacheStorage = {};
  },

  /**
   * Load page content via AJAX with partial rendering
   * @param {string} url - The URL to load content from
   * @param {boolean} [cache=false] - Whether to use strict cache (no AJAX revalidation)
   * @param {boolean} [scroll=true] - Whether to scroll to top
   */
  loadPage(url, cache = false, scroll = true) {
    if (url !== window.location.href) {
      window.history.pushState({}, "", url);
    }

    const cachedPage = this.getCache(url);

    if (cachedPage) {
      this.updateContent(cachedPage,url);
      if (scroll) $(window).scrollTop(0); // Fixed scroll logic
      if (cache) return false;
    } else {
      this.$mainContainer
        .css("min-height", this.$mainContainer.height())
        .html('<div class="loading-text">Loading...</div>');
    }

    const ajaxUrl = `${url}${url.includes("?") ? "&" : "?"}partial=1&layout=${this.$mainContainer.data("layout")}`;

    $.ajax({
      url: ajaxUrl,
      method: "GET",
      success: (response) => {
        if (response === "unauthorized") {
          window.location.reload();
        } else if (response === "reload" || response.includes("<body")) {
          window.location.href = url;
        } else {
          if (cachedPage === response) {
            return false; // Avoid re-rendering if identical
          }

          this.setCache(url, response);
          this.updateContent(response,url);

          // Scroll if not already handled by cache hit
          if (scroll && !cachedPage) {
            $(window).scrollTop(0);
          }
        }
      },
      error: (xhr) => {
        try {
          const response = JSON.parse(xhr.responseText);
          // Used text() instead of html() to prevent XSS attacks
          this.$mainContainer.text(
            response.message || "An error occurred while loading the page.",
          );
        } catch {
          window.location.href = url;
        }
      },
    });
  },

  /**
   * Update content in main container
   * @param {string} html - The HTML content to update
   * @param {string} url - The URL of the loaded page
   */
  updateContent(html,url) {
    this.$mainContainer.html(html).css("min-height", 0);
    $("title").text($("#main-content").data("title"));
    this.runDocumentReady();
    this.onPageLoaded(url);
  },

  /**
   * Set up click handlers for pjax-enabled links
   */
  routeLinks() {
    $(document).on("click", "a.pjax", (e) => {
      const target = e.currentTarget;
      const href = target.href;

      // Ignore invalid links and anchors
      if (!href || href.match(/#|javascript:|undefined/)) return;

      // Let the browser handle specialized clicks natively (new tab/window)
      if (
        e.metaKey ||
        e.ctrlKey ||
        e.shiftKey ||
        e.button !== 0 ||
        target.target === "_blank"
      ) {
        return;
      }

      e.preventDefault();

      const scroll = target.getAttribute("data-pjax-scroll") !== "false";
      const cache = target.hasAttribute("data-pjax-cache");

      this.loadPage(href, cache, scroll);
      this.onLinkClick();
    });
  },

  /**
   * Executes all registered document-ready functions.
   */
  runDocumentReady() {
    if (
      typeof documentReadyFunctions !== "undefined" &&
      documentReadyFunctions
    ) {
      let oldDocumentReadyFunctions = documentReadyFunctions;
      documentReadyFunctions = [];
      $.each(oldDocumentReadyFunctions, function (index, cb) {
        try {
          cb();
        } catch (e) {
          console.error("pjax: Error in document-ready function", e);
        }
      });
    }
  },

  /**
   * Initialize pjax functionality
   */
  init() {
    this.$mainContainer = $("#main-container");
    if (!this.$mainContainer.length)
      return console.error("pjax: Main container not found");

    // Expose runDocumentReady globally
    window.runDocumentReady = this.runDocumentReady;

    this.routeLinks();
    window.addEventListener("popstate", () =>
      this.loadPage(window.location.href),
    );
    this.runDocumentReady();
    return this;
  },
};
