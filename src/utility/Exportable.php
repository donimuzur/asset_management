<?php
namespace App\Utility;

interface Exportable {
    public function getExportHeaders();
    public function getExportData();
}

