<?php
include '../Includes/dateRange.inc';

$dateRange = new dateRange();

$dateFrom = "2016-07-06";
$dateTo = "2016-07-09";
$result = $dateRange->createDateRangeArray($dateFrom, $dateTo);
print_r($result);
