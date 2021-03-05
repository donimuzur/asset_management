<?php
namespace App\Helper\Utility;

interface Exportable {
    public function getExportHeaders();
    public function getExportData();
}

