<?php

require_once 'pdfToText.php';

$filename = $argv[1];

//$filename = "/home/test/ParseFiles/files/ALL.pdf";
$result = pdfToText($filename);

preg_match_all('/Disease Description:(.*)Printed by Larry Page/simU',$result,$out);

echo "Disease Description\tSpecific Indication\tMolecular Abnormality\tTest\tChromosome\tGene Symbol\tTest Detects\tMethodology\tNCCN Category of Evidence\tSpecimen Types\tNCCN Recommendation - Clinical Decision\tTest Purpose\tWhen to Test\tGuideline Page with Test Recommendation\tNotes\n";

$no_of_records = count($out[0]);
for($i=0;$i<$no_of_records;$i++){
    preg_match('/Disease Description:(.*)Specific Indication:(.*)Molecular Abnormality:(.*)Test:(.*)Chromosome:(.*)Gene Symbol:(.*)NCCN Category of Evidence:(.*)Specimen Types:(.*)NCCN Recommendation - Clinical Decision:(.*)Test Purpose:(.*)When to Test:(.*)Guideline Page with Test Recommendation:(.*)Notes:(.*)Compendium/simU',$out[0][$i],$values);
    $no_of_data_per_record = count($values);
    for($j=1;$j<$no_of_data_per_record;$j++){
        $values[$j]=preg_replace(array('/\r,/','/\n/'),"",$values[$j]);
        echo $values[$j]."\t";
    }
    echo PHP_EOL;
}
