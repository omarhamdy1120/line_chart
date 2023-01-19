<?php include_once("db_config.php");
ini_set('memory_limit', '536870912M');
$min=15959986;
$max_ChartQrt = $conn->query("SELECT
DATE_FORMAT(DateOfRecord,'%Y-%m-%d') AS DatePrices,
YEAR(DateOfRecord) AS thisYear,
MIN(Sell) AS SellQrt,
MAX(Buy) AS BuyQrt,
MAX(WorldPrice) AS WorldPriceQrt
FROM live_price
GROUP BY DatePrices
ORDER BY ID asc; ") or die($conn->error);


$resultjson_dataChart = array();
  while ($row=$max_ChartQrt->fetch_assoc()) {
      $resultjson_dataChart[] = $row;
  }
$final= json_encode($resultjson_dataChart);
echo $final;
$fp_dataChart = fopen('dataChartQrt.json', 'w');
fwrite($fp_dataChart, json_encode($resultjson_dataChart));
fclose($fp_dataChart);
?>