<?php

$errors         = array();  	// array to hold validation errors
$data 			= array(); 		// array to pass back data

$responseArray = array();

function GetTableStructure(){
	$positionManager = new SimpleTableManager();
    $positionManager->Initialize("position");
    
    return $positionManager->selectPrimaryKeyList();
}

function FindData($requestData){
	$positionManager = new SimpleTableManager();
    $positionManager->Initialize("position");

	$updateRows = new stdClass();
	$updateRows = $requestData->Data->Header;
    
	foreach ($updateRows as $keyIndex => $rowItem) {
        foreach ($rowItem as $columnName => $value) {
            $positionManager->$columnName = $value;
        }
        $responseArray = $positionManager->select();
        break;
    }
    
	return $responseArray;
}

function GetData($requestData){
	$positionManager = new SimpleTableManager();
    $positionManager->Initialize("position");
    
	$offsetRecords = 0;
	$offsetRecords = $requestData->Offset;
	$pageNum = $requestData->PageNum;

	$responseArray = $positionManager->selectPage($offsetRecords);
    
	return $responseArray;

}

?>