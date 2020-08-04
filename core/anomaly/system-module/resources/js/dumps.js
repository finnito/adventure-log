(function (window, document) {

    setInterval(function () {

        let request = new XMLHttpRequest();

        request.open('GET', REQUEST_ROOT_PATH + '/admin/system/telescope/dumps', true);
        request.setRequestHeader('Content-Type', 'application/json');

        request.send();

    }, 2000);

})(window, document);
