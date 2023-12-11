<?php
/* Getting the html content from the Wikipedia page*/
$url = 'https://en.wikipedia.org/wiki/List_of_municipalities_of_Norway';
$html = file_get_contents($url);

/* Creating a dom document to handle HTML */
$dom = new DOMDocument;
libxml_use_internal_errors(true);  /* Enabling internal error handling */
$dom->loadHTML($html);
libxml_clear_errors(); /* Clearing any accumulated errors /*

/* Finding the table with Norwegian municipalities using XPath */
$xpath = new DOMXPath($dom);
$tableNodes = $xpath->query('//table[contains(@class, "wikitable")]');

/* Checking if the table is found */
if ($tableNodes->length > 0) {
    /* Getting the table content from the DOM document */
    $tableHtml = $dom->saveHTML($tableNodes->item(0));

    /* Styling the HTML page and extracted table */
    $outputHtml = "<!DOCTYPE html>
                    <html lang='en'>
                    <head>
                        <meta charset='UTF-8'>
                        <title>Municipality list of Norway</title>
                        <style>
                            body {
                                font-family: 'Arial', sans-serif;
                                margin: 18px;
                            }
                            h1 {
                                color: #001F3F;
                            }
                            table {
                                border-collapse: collapse;
                                width: 100%;
                                margin-top: 20px;
                            }
                            th, td {
                                border: 1px solid #556B2F;
                                padding: 8px;
                                text-align: left;
                            }
                            th {
                                background-color: #F5F5F5;
                            }

                            footer {
                                background-color: #335;
                                color: #fff;
                                width: 100%;
                                padding: 40px;
                            }
                        </style>
                    </head>
                    <body>
                        <h1>List of Municipalities of Norway</h1>
                        $tableHtml

                        <footer>
                        <div>
                        Copyright &copy; [This website was created by the candidate 10074.] [2023]
                        </div>
                        </footer>
                    </body>
                    </html>";

    /* Displaying the page */
    echo $outputHtml;
} else {
    /* Showing this error message if the table is not found */
    echo "Table not found on the Wikipedia page.";
}
?>
