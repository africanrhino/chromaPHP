
<?php 
include 'chromaPHP.php';

// Instantiate a new FastAPIClient with the base URL of the FastAPI server
$client = new chromaPHP("http://localhost:8000");


// Example usage for createCollection function
echo "\033[0;33m=== Create Collection ===\033[0m" . PHP_EOL;
$response = $client->createCollection('my_collection', ['field1' => 'value1'], true);
echo $response . PHP_EOL;

// Example usage for listCollections function
echo "\033[0;33m=== List Collections ===\033[0m" . PHP_EOL;
$response = $client->listCollections();
echo $response . PHP_EOL;

echo "\033[0;33m=== Add Embeddings ===\033[0m" . PHP_EOL;

$embeddings = [
    [0.1, 0.2, 0.3],
    [0.4, 0.5, 0.6],
    [0.7, 0.8, 0.9]
];
$metadatas = [['name' => 'embedding1'], ['name' => 'embedding2'], ['name' => 'embedding3']];
$documents = [
    'This is the document for embedding 1',
    'This is the document for embedding 2',
    'This is the document for embedding 3'
];
$ids = ['id1', 'id2','id3'];
$result = $client->addEmbeddings('my_collection', $embeddings, $metadatas, $documents, $ids, false);
echo json_encode($result) . PHP_EOL;

echo "\033[0;33m=== Get Embeddings ===\033[0m" . PHP_EOL;
$ids = null;
$where = null;
$whereDocument = null;
$sort = null;
$limit = null;
$offset = null; 
$include = ['embeddings', 'metadatas', 'documents'];
$response = $client->getEmbeddings('my_collection', $ids, $where, $whereDocument, $sort, $limit, $offset, $include);
echo json_encode($response) . PHP_EOL;


// Example usage for count function
echo "\033[0;33m=== Count Embeddings ===\033[0m" . PHP_EOL;
$response = $client->count('my_collection');
echo $response . PHP_EOL;

// Example usage for createIndex function
echo "\033[0;33m=== Create Index ===\033[0m" . PHP_EOL;
$response = $client->createIndex('my_collection');
echo $response . PHP_EOL;

// Example usage for getNearestNeighbors function
echo "\033[0;33m=== Get Nearest Neighbors ===\033[0m" . PHP_EOL;
$include = ['embeddings', 'metadatas', 'documents'];
$response = $client->getNearestNeighbors('my_collection', [[0.1, 0.2, 0.3]], 2, $include);
echo $response . PHP_EOL;



// Example usage for rawSql function
echo "\033[0;33m=== Execute Raw SQL ===\033[0m" . PHP_EOL;
$response = $client->rawSql('SELECT * FROM my_collection');
echo $response . PHP_EOL;

// Example usage for deleteEmbedding function
echo "\033[0;33m=== Delete Embedding ===\033[0m" . PHP_EOL;
$response = $client->deleteEmbedding('my_collection', null, null, null);
echo $response . PHP_EOL;


// Example usage for reset function
echo "\033[0;33m=== Reset Chroma ===\033[0m" . PHP_EOL;
$response = $client->reset();
echo $response . PHP_EOL;
