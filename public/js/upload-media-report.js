function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {
        // Only process image files.
        if (!f.type.match('image.*')) {
            alert("Image only please....");
        }
        var reader = new FileReader();
        // Closure to capture the file information.
        reader.onload = (function (theFile) {
            return function (e) {
                // Render thumbnail.
                var span = document.createElement('span');
                span.innerHTML = ['<img class="img-span" style="height: 75px;border: 1px solid #000;margin: 10px 5px 0 0;display: inline-block;padding: 4px;line-height: 1.42857143;background-color: #fff;border: 1px solid #ddd;border-radius: 4px; -webkit-transition: all .2s ease-in-out; -o-transition: all .2s ease-in-out;transition: all .2s ease-in-out;" "title="', escape(theFile.name), '" src="', e.target.result, '" />'].join('');
                document.getElementById('outputMulti').insertBefore(span, null);
            };
        })(f);
        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }
}

document.getElementById('fileMulti').addEventListener('change', handleFileSelect, false);