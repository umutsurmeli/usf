<?php
namespace umutsurmeli\app\library;
class codemirror {
public $readOny = false;
    public function header() { 
        $base_url = base_url();
        $gereksinimler = '<link rel="stylesheet" href="'.$base_url.'assets/CodeMirror/codemirror.css">
<script src="'.$base_url.'assets/CodeMirror/codemirror.js"></script>
<script src="'.$base_url.'assets/CodeMirror/vmatchbrackets.js"></script>
<script src="'.$base_url.'assets/CodeMirror/htmlmixed.js"></script>
<script src="'.$base_url.'assets/CodeMirror/xml.js"></script>
<script src="'.$base_url.'assets/CodeMirror/javascript.js"></script>
<script src="'.$base_url.'assets/CodeMirror/css.js"></script>
<script src="'.$base_url.'assets/CodeMirror/clike.js"></script>
<script src="'.$base_url.'assets/CodeMirror/php.js"></script>
<style>.CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black;}</style>';
        return $gereksinimler;
    }
    public function body($code,$ElementId,$returnElement=true) {
        $kaynak = '';
        if($returnElement) {
            $kaynak .= '<form><textarea id="'.$ElementId.'" name="'.$ElementId.'" style="display: none;">';
            $kaynak .= $code.'</textarea></form>';
        }
            
        $kaynak .= '
    <script>
      var editor = CodeMirror.fromTextArea(document.getElementById("'.$ElementId.'"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 4,';
        if($this->readOny) {
            $kaynak .= ' 
        readOnly:true,';
       
        }
        $kaynak .= '
        indentWithTabs: true
      });
    </script>';
        
        return $kaynak;
    }
}