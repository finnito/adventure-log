(function (window, document) {

    /**
     * Setup the code examples
     */
    let examples = Array.prototype.slice.call(
        document.querySelectorAll('pre[class~="language"] > code')
    );

    examples.forEach(function (code, index) {

        code.setAttribute('id', 'code-' + (index + 1));

        Prism.highlightElement(code);
    });

})(window, document);
