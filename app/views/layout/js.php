<!--
	Javascript includes
-->

<!-- Core libs -->
<?php AppCompiler::js('http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js'); ?>
<?php AppCompiler::js('js/core/libs/mustache.js'); ?>
<?php AppCompiler::js('js/core/libs/mustache.render.js'); ?>

<!-- Templates -->
<?php AppCompiler::js('compile/templates.js'); ?>

<!-- App -->
<?php AppCompiler::js('js/app/app.js'); ?>