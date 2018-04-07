<?php
$states = array(
"Alabama", "Alaska", "Arizona", "Arkansas",
"California", "Colorado", "Connecticut", "Delaware",
"District of Columbia", "Florida", "Georgia", "Hawaii",
"Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky",
"Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan",
"Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska",
"Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York",
"North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon",
"Pennsylvania", "Rhode Island", "South Carolina", "South Dakota",
"Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington",
"West Virginia", "Wisconsin", "Wyoming");

$q = $_REQUEST["q"];

$hint = "";

if ($q !== "") {
  $q = strtolower($q);
  $len = strlen($q);
  foreach ($states as $state) {
    if (stristr($q, substr($state, 0, $len))) {
      if ($hint === '') {
        $hint = $state;
      }
      else {
        $hint .= ", $state";
      }
    }
  }
}
if ($hint === "" && strlen($q)!=0) {
  echo "No suggestions";
}
else {
  echo $hint;
}
// echo $hint === "" ? "No suggestion" : $hint;
?>
