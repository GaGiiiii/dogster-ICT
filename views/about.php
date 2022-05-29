<div id="export">
    <div class="col-md-10 offset-md-1 mt-5 mb-5">
        <h1 class="text-center mb-4">About me :)</h1>
        <div class="card mb-3 shadow">
            <div class="image-container">
                <img src="./assets/images/mojaslika.jpeg" class="card-img-top img-thumbnail mojaslika" style="width: 400px;">
            </div>
            <div class="card-body">
                <p class="card-text mt-0">
                    Zdravo, ja sam Jana Matović. Rođena sam u Prijepolju i imam 22 godine. Završila sam gimnaziju, prirodno-matematički smer, a trenutno sam student 3. godine “Visoke škole za informacione i komunikacione tehnologije”. Smer: Informacione tehnologije Modul: Web programiranje
                </p>
                <button onclick="ExportToDoc('export');">Export as .doc</button>
            </div>
        </div>
    </div>
</div>

<script>
    function ExportToDoc(element, filename = '') {
        var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";

        var footer = "</body></html>";

        var html = header + document.getElementById(element).innerHTML + footer;

        var blob = new Blob(['\ufeff', html], {
            type: 'application/msword'
        });

        // Specify link url
        var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);

        // Specify file name
        filename = filename ? filename + '.docx' : 'document.docx';

        // Create download link element
        var downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if (navigator.msSaveOrOpenBlob) {
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            // Create a link to the file
            downloadLink.href = url;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }

        document.body.removeChild(downloadLink);
    }
</script>