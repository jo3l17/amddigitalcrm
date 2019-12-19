</div>
</div>
</div>
</body>

</html>
<?php
ArchivosHead::ListarFw('datatables', 'datatables.min.js');
ArchivosHead::ListarFw('datatables', 'datatables.min.css');
ArchivosHead::ListarFw('vuejs', 'vue.js');
ArchivosHead::ListarFw('vuejs', 'vuex.js');
ArchivosHead::ListarFw('vuejs', 'vue-resource.min.js');
ArchivosHead::ListarFw('summernote', 'summernote-bs4.css');
ArchivosHead::ListarFw('summernote', 'summernote-bs4.js');
ArchivosHead::ListarFw('summernote\lang', 'summernote-es-ES.js');

ArchivosHead::ListarFw('jqueryupload\css', 'uploadfile.min.css');
ArchivosHead::ListarFw('jqueryupload\js', 'jquery.uploadfile.js');

ArchivosHead::ListarCarpetas('js');
ArchivosHead::ListarFw(URLJS, $this->archivo . '.js', true);


?>
