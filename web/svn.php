<?php
echo shell_exec('svn update ../');
echo '<br>';
echo shell_exec('php ../yii migrate --interactive=0');

