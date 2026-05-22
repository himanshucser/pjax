# Easy and Powerful PJAX : Single Page Application (SPA) Library

`pjax.js` is a lightweight and efficient library for implementing Single Page Applications (SPA) in Laravel, CodeIgniter, or any PHP-based project. It enables partial page loads and seamless navigation without full-page reloads, enhancing user experience and performance.

## Features

- **Partial Page Loading**: Load only the required content via AJAX.
- **Session Storage Caching**: Cache pages for faster navigation.
- **Dynamic Menu Updates**: Automatically update active menu items based on the current URL.
- **Customizable**: Easily integrate with Laravel, CodeIgniter, or other PHP frameworks.
- **Scroll Management**: Control scroll behavior during navigation.
- **Error Handling**: Graceful handling of unauthorized or error responses.

## Installation

1. Clone or download the repository.
2. Include `pjax.js` in your project:

```html
<script src="path/to/pjax.js"></script>
```

3. Ensure you have jQuery included in your project as `pjax.js` depends on it.

```html
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
```

## Usage

### HTML Setup

Wrap your main content in a container with the ID `main-container`:

```html
<div id="main-container" data-layout="main">
  <div id="main-content" data-title="">
    <!-- Main content goes here -->
    <div></div>
  </div>
</div>
```

Add the `pjax` class to your links to enable PJAX navigation:

```html
<a href="/example" class="pjax">Example Link</a>
```

### JavaScript Initialization

Initialize `pjax.js` when the DOM is ready. You can also define hooks to run custom code during navigation:

```javascript
$(document).ready(function() {
  // Hook executed when a PJAX link is clicked
  pjax.onLinkClick = function(target) {
    // e.g., Show a custom loader or update UI
    $(target).addClass('active').siblings().removeClass('active');
  };

  // Hook executed after page content is updated
  pjax.onPageLoaded = function(url) {
    // e.g., Send pageview to analytics
    console.log("Successfully loaded: " + url);
  };

  pjax.init();
});
```

### Server-Side Integration

Ensure your server can handle partial requests by checking for the `partial` query parameter. For example, in PHP:

```php
if (isset($_GET['partial']) && isset($_GET['layout']) && $_GET['layout'] == 'main') {
    include 'partials/content.php';
}
```

## Rules for PJAX SPA Functionality

- Each link (`<a>` tag) where you want to apply PJAX SPA functionality must include the `pjax` class.
- The `data-pjax-cache` attribute is optional and should only be used for static pages that need to be cached in the browser.

### Caching

To enable caching for specific links, add the `data-pjax-cache` attribute:

```html
<a href="/example" class="pjax" data-pjax-cache="true">Cached Link</a>
```

### Scroll Behavior

Control scroll behavior by setting the `data-pjax-scroll` attribute:

```html
<a href="/example" class="pjax" data-pjax-scroll="false">No Scroll</a>
```

## Run JavaScript Code After PJAX Updates

### HTML Setup

Add the following script to the header of your HTML file:

```html
<script>
  var documentReadyFunctions = [];
  function documentReady(fn) {
    documentReadyFunctions.push(fn);
  }
</script>
```

### JavaScript Execution After Content Update

To ensure JavaScript code runs after PJAX updates, include the following function call at the bottom of your view:

```javascript
documentReady(function () {
  //add your code here
});
```

This function will execute all registered `documentReady` functions after the HTML content is updated. this is alternative to jquery $(document).ready()

## API Documentation

### `pjax` Object

#### Hooks

- `pjax.onLinkClick(target)`
  - Function executed when a PJAX-enabled link is clicked.
- `pjax.onPageLoaded(url)`
  - Function executed after PJAX successfully loads and updates the page content.

#### Methods

- `pjax.init()`
  - Initialize PJAX functionality.
- `pjax.loadPage(url, cache, scroll)`
  - Load page content via AJAX.
- `pjax.updateContent(html)`
  - Update the main container with new content.
- `pjax.updateActiveMenuByUrl()`
  - Update active menu items based on the current URL.
- `pjax.routeLinks()`
  - Set up click handlers for PJAX-enabled links.

## Contributing

Contributions are welcome! Feel free to submit issues or pull requests to improve this library.

## License

This project is licensed under the MIT License. See the LICENSE file for details.

## Acknowledgments

Special thanks to the open-source community for inspiration and support.
