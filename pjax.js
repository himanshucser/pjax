/**
 * @typedef {Object} Pjax
 * @property {jQuery} $mainContainer - jQuery reference to main container
 * @property {Array} cache - Cached pages for faster navigation
 * @description Client-side pjax implementation for handling SPA navigation and partial page loads
 */
/**
 * Executes all registered document-ready functions.
 */
function runDocumentReady() {
    if (documentReadyFunctions) {
        let oldDocumentReadyFunctions = documentReadyFunctions;
        documentReadyFunctions = [];
        $.each(oldDocumentReadyFunctions, function (index, cb) {
            try {
                cb();
            } catch (e) {
                console.error(e);
            }
        });
    }
}
/**
 * AppCache class for storing and retrieving page data in sessionStorage.
 */
class AppCache {
    static cacheEnabled = true;
    /**
     * Encode a key to Base64 format.
     * @param {string} key - The key to encode.
     * @returns {string} - The Base64 encoded key.
     */
    static encodeKey(key) {
        return btoa(key.replace($('base').attr('href')));
    }

    /**
     * Save data to sessionStorage using an encoded key.
     * @param {string} key - The key under which data is stored.
     * @param {string} value - The string value to store.
     */
    static set(key, value) {
        if (!AppCache.cacheEnabled) return false;
        const encodedKey = this.encodeKey(key);
        try {
            sessionStorage.setItem(`cache_${encodedKey}`, value);
        } catch (e) {
            AppCache.clear();
        }
    }

    static setData(key, data) {
        if (!AppCache.cacheEnabled) return false;
        const encodedKey = this.encodeKey(key);
        try {
            sessionStorage.setItem(`cache_${encodedKey}`, JSON.stringify(data));
        } catch (e) {
            AppCache.clear();
        }
    }

    /**
     * Retrieve data from sessionStorage.
     * @param {string} key - The key of the stored data.
     * @returns {string | null} - The retrieved string data or null if not found.
     */
    static get(key) {
        if (!AppCache.cacheEnabled) return false;
        const encodedKey = this.encodeKey(key);
        return sessionStorage.getItem(`cache_${encodedKey}`);
    }

    static getData(key) {
        if (!AppCache.cacheEnabled) return false;
        const encodedKey = this.encodeKey(key);
        let cachedData = sessionStorage.getItem(`cache_${encodedKey}`);
        return cachedData ? JSON.parse(cachedData) : null;
    }

    /**
     * Remove a specific item from sessionStorage.
     * @param {string} key - The key of the item to remove.
     */
    static remove(key) {
        if (!AppCache.cacheEnabled) return false;
        const encodedKey = this.encodeKey(key);
        sessionStorage.removeItem(`cache_${encodedKey}`);
    }

    /**
     * Clear all cache data from sessionStorage.
     */
    static clear() {
        sessionStorage.clear();
    }
}

const pjax = {
    /** @type {jQuery} jQuery reference to main container */
    $mainContainer: null,
    /**
     * Load page content via AJAX with partial rendering
     * @param {string} url - The URL to load content from
     * @param {boolean} [cache=false] - Whether to cache the page content
     * @param {boolean} [scroll=true] - Whether to scroll to top
     */
    loadPage(url, cache = false, scroll = true) {
        if(url!=window.location.href){
            window.history.pushState({}, "", url);
        }
        //cache code
        const cachedPage = AppCache.get(url);
        if(cachedPage){
            this.updateContent(cachedPage);
            if (!scroll) $(window).scrollTop(0);
            if(cache){return false;}
        }else{
            this.$mainContainer.css("min-height", this.$mainContainer.height()).html('<div class="loading-text">Loading...</div>');
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
                    //cache start
                    if(cachedPage==response){
                        return false;
                    }
                    AppCache.set(url,response);
                    //cache end
                    
                    this.updateContent(response, scroll);
                    if (!scroll) $(window).scrollTop(0);
                }
            },
            error: (xhr) => {
                try {
                    const response = JSON.parse(xhr.responseText);
                    this.$mainContainer.html(response.message || "");
                } catch {
                    window.location.href = url;
                }
            }
        });
    },

    /**
     * Update content in main container
     * @param {string} html - The HTML content to update
     * @param {boolean} scroll - Whether to scroll to top
     */
    updateContent(html) {
        this.$mainContainer.html(html).css("min-height", 0);
        $("title").text($("#main-content").data("title"));
        runDocumentReady();
        this.updateActiveMenuByUrl();
    },

    /**
     * Update active and open classes on menu based on current URL
     */
    updateActiveMenuByUrl() {
        const currentUrl = window.location.href;
        // Remove existing active and open classes
        $(".menu-item").removeClass("active open");
        // Find menu links matching current URL
        const matchingLinks = $(".menu-link").filter(function() {
            return this.href === currentUrl;
        });
        if (matchingLinks.length) {
            matchingLinks.each(function() {
                const $link = $(this);
                $link.parent().addClass("active");
                $link.parents(".menu-item").addClass("open active");
            });
        }
    },

    /**
     * Set up click handlers for pjax-enabled links
     */
    routeLinks() {
        $(document).on("click", "a.pjax", (e) => {
            const target = e.currentTarget;
            const href = target.href;
            
            if (!href || href.match(/#|javascript:void|undefined/)) return;
            if (e.ctrlKey || target.target === "_blank") return window.open(href, "_blank");
            
            e.preventDefault();
            
            const scroll = target.getAttribute("data-pjax-scroll") !== "false";
            const cache = target.hasAttribute("data-pjax-cache");
            
            this.loadPage(href, cache, scroll);
            this.updateLinkClass(target);
        });
    },

    /**
     * Update link class for pjax-enabled links
     * @param {HTMLElement} target - The clicked link element
     */
    updateLinkClass(target) {
        target=$(target);
        if (target.hasClass("menu-link")) {
        }
    },

    /**
     * Initialize pjax functionality
     */
    init() {
        this.$mainContainer = $("#main-container");
        if (!this.$mainContainer.length) return console.error("pjax: Main container not found");

        this.routeLinks();
        window.addEventListener("popstate", () => this.loadPage(window.location.href));

    }
};
