<?php include 'layout/header.php'; ?>
<div id="main-content" data-title="PJAX Documentation">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-5">
                        <h1 class="display-5 fw-bold mb-4 text-primary">Easy and Powerful PJAX</h1>
                        <p class="lead text-muted mb-5">Single Page Application (SPA) Library</p>
                        
                        <p><code>pjax.js</code> is a lightweight and efficient library for implementing Single Page Applications (SPA) in Laravel, CodeIgniter, or any PHP-based project. It enables partial page loads and seamless navigation without full-page reloads, enhancing user experience and performance.</p>

                        <hr class="my-5">

                        <h2 class="fw-bold mb-4">Features</h2>
                        <ul class="list-group list-group-flush mb-5">
                            <li class="list-group-item bg-transparent px-0 border-0 d-flex"><i class="bi bi-check-circle-fill text-success me-3 mt-1"></i> <div><strong>Partial Page Loading</strong>: Load only the required content via AJAX.</div></li>
                            <li class="list-group-item bg-transparent px-0 border-0 d-flex"><i class="bi bi-check-circle-fill text-success me-3 mt-1"></i> <div><strong>Session Storage Caching</strong>: Cache pages for faster navigation.</div></li>
                            <li class="list-group-item bg-transparent px-0 border-0 d-flex"><i class="bi bi-check-circle-fill text-success me-3 mt-1"></i> <div><strong>Dynamic Menu Updates</strong>: Automatically update active menu items based on the current URL.</div></li>
                            <li class="list-group-item bg-transparent px-0 border-0 d-flex"><i class="bi bi-check-circle-fill text-success me-3 mt-1"></i> <div><strong>Customizable</strong>: Easily integrate with Laravel, CodeIgniter, or other PHP frameworks.</div></li>
                            <li class="list-group-item bg-transparent px-0 border-0 d-flex"><i class="bi bi-check-circle-fill text-success me-3 mt-1"></i> <div><strong>Scroll Management</strong>: Control scroll behavior during navigation.</div></li>
                            <li class="list-group-item bg-transparent px-0 border-0 d-flex"><i class="bi bi-check-circle-fill text-success me-3 mt-1"></i> <div><strong>Error Handling</strong>: Graceful handling of unauthorized or error responses.</div></li>
                        </ul>

                        <h2 class="fw-bold mb-4">Installation</h2>
                        <ol class="mb-5">
                            <li class="mb-3">Clone or download the repository.</li>
                            <li class="mb-3">Include <code>pjax.js</code> in your project:
                                <pre class="bg-light p-3 rounded mt-2"><code>&lt;script src="path/to/pjax.js"&gt;&lt;/script&gt;</code></pre>
                            </li>
                            <li class="mb-3">Ensure you have jQuery included in your project as <code>pjax.js</code> depends on it.
                                <pre class="bg-light p-3 rounded mt-2"><code>&lt;script src="https://code.jquery.com/jquery-3.6.0.min.js"&gt;&lt;/script&gt;</code></pre>
                            </li>
                        </ol>

                        <hr class="my-5">

                        <h2 class="fw-bold mb-4">Usage</h2>
                        
                        <h4 class="fw-bold mt-4">HTML Setup</h4>
                        <p>Wrap your main content in a container with the ID <code>main-container</code>:</p>
                        <pre class="bg-light p-3 rounded mb-4"><code>&lt;div id="main-container" data-layout="main"&gt;
  &lt;div id="main-content" data-title=""&gt;
    &lt;!-- Main content goes here --&gt;
    &lt;div&gt;&lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>

                        <p>Add the <code>pjax</code> class to your links to enable PJAX navigation:</p>
                        <pre class="bg-light p-3 rounded mb-5"><code>&lt;a href="/example" class="pjax"&gt;Example Link&lt;/a&gt;</code></pre>

                        <h4 class="fw-bold mt-4">JavaScript Initialization</h4>
                        <p>Initialize <code>pjax.js</code> when the DOM is ready:</p>
                        <pre class="bg-light p-3 rounded mb-5"><code>function onlinkClick(target) {
  //add your custom code here for example
  $(target).addClass("active").siblings().removeClass("active");
}
$(document).ready(() =&gt; pjax.init(onlinkClick));</code></pre>

                        <h4 class="fw-bold mt-4">Server-Side Integration</h4>
                        <p>Ensure your server can handle partial requests by checking for the <code>partial</code> query parameter. For example, in PHP:</p>
                        <pre class="bg-light p-3 rounded mb-5"><code>if (isset($_GET['partial']) && isset($_GET['layout']) && $_GET['layout'] == 'main') {
    include 'partials/content.php';
}</code></pre>

                        <hr class="my-5">

                        <h2 class="fw-bold mb-4">Rules for PJAX SPA Functionality</h2>
                        <ul class="mb-5">
                            <li class="mb-2">Each link (<code>&lt;a&gt;</code> tag) where you want to apply PJAX SPA functionality must include the <code>pjax</code> class.</li>
                            <li class="mb-2">The <code>data-pjax-cache</code> attribute is optional and should only be used for static pages that need to be cached in the browser.</li>
                        </ul>

                        <h4 class="fw-bold mt-4">Caching</h4>
                        <p>To enable caching for specific links, add the <code>data-pjax-cache</code> attribute:</p>
                        <pre class="bg-light p-3 rounded mb-5"><code>&lt;a href="/example" class="pjax" data-pjax-cache="true"&gt;Cached Link&lt;/a&gt;</code></pre>

                        <h4 class="fw-bold mt-4">Scroll Behavior</h4>
                        <p>Control scroll behavior by setting the <code>data-pjax-scroll</code> attribute:</p>
                        <pre class="bg-light p-3 rounded mb-5"><code>&lt;a href="/example" class="pjax" data-pjax-scroll="false"&gt;No Scroll&lt;/a&gt;</code></pre>

                        <hr class="my-5">

                        <h2 class="fw-bold mb-4">Run JavaScript Code After PJAX Updates</h2>
                        
                        <h4 class="fw-bold mt-4">HTML Setup</h4>
                        <p>Add the following script to the header of your HTML file:</p>
                        <pre class="bg-light p-3 rounded mb-4"><code>&lt;script&gt;
  var documentReadyFunctions = [];
  function documentReady(fn) {
    documentReadyFunctions.push(fn);
  }
&lt;/script&gt;</code></pre>

                        <h4 class="fw-bold mt-4">JavaScript Execution After Content Update</h4>
                        <p>To ensure JavaScript code runs after PJAX updates, include the following function call at the bottom of your view:</p>
                        <pre class="bg-light p-3 rounded mb-4"><code>documentReady(function () {
  //add your code here
});</code></pre>
                        <p class="text-muted mb-5">This function will execute all registered <code>documentReady</code> functions after the HTML content is updated. this is alternative to jquery $(document).ready()</p>

                        <hr class="my-5">

                        <h2 class="fw-bold mb-4">API Documentation</h2>
                        
                        <h4 class="fw-bold mt-4"><code>pjax</code> Object Methods</h4>
                        <ul class="list-group list-group-flush mb-5">
                            <li class="list-group-item bg-transparent px-0 border-bottom"><strong>pjax.init()</strong>: Initialize PJAX functionality.</li>
                            <li class="list-group-item bg-transparent px-0 border-bottom"><strong>pjax.loadPage(url, cache, scroll)</strong>: Load page content via AJAX.</li>
                            <li class="list-group-item bg-transparent px-0 border-bottom"><strong>pjax.updateContent(html)</strong>: Update the main container with new content.</li>
                            <li class="list-group-item bg-transparent px-0 border-bottom"><strong>pjax.updateActiveMenuByUrl()</strong>: Update active menu items based on the current URL.</li>
                            <li class="list-group-item bg-transparent px-0 border-0"><strong>pjax.routeLinks()</strong>: Set up click handlers for PJAX-enabled links.</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'layout/footer.php'; ?>