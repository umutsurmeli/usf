<?php
namespace umutsurmeli\app\library;
class sceditor {
    
    public function header() { 
        $base_url = base_url();
        $gereksinimler = '<link rel="stylesheet" href="'.$base_url.'assets/sceditor-3.0.0/minified/themes/default.min.css"/>';
        $gereksinimler .= '<script src="'.$base_url.'assets/sceditor-3.0.0/minified/sceditor.min.js"></script>';
        $gereksinimler .= '<script src="'.$base_url.'assets/sceditor-3.0.0/minified/icons/monocons.js"></script>';
        $gereksinimler .= '<script src="'.$base_url.'assets/sceditor-3.0.0/minified/formats/xhtml.js"></script>';
        $gereksinimler .= '<script src="'.$base_url.'assets/sceditor-3.0.0/languages/tr.js"></script>';
        return $gereksinimler;
    }
    public function body($code,$ElementId,$returnElement=true) {
        $kaynak = '';
        if($returnElement) {
            $kaynak .= '<textarea cols="80" id="'.$ElementId.'" name="'.$ElementId.'" rows="10">';
            $kaynak .= $code.'</textarea>';
        }
            
        $kaynak .= '
	<script type="text/javascript">

		var textarea = document.getElementById("'.$ElementId.'");
			sceditor.create(textarea, {
				format: "xhtml",
				icons: "monocons",
                                height: 350,
                                width:650,
				style: "'.base_url().'assets/sceditor-3.0.0/minified/themes/content/default.min.css"
			});


        </script>';
        
        return $kaynak;
    }
}