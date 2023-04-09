
<?php 
include 'chromaPHP.php';

// Instantiate a new FastAPIClient with the base URL of the FastAPI server
$client = new chromaPHP("http://localhost:8000");


// Create a new collection named "my_collection" with some metadata and set get_or_create flag to false
$collectionName = 'my_collection';
$metadata = ['description' => 'A collection of dummy embeddings'];
$getOrCreate = false;
echo "Creating collection '$collectionName'...\n";
$start = microtime(true);
$response = $client->createCollection($collectionName, $metadata, $getOrCreate);
$elapsed = microtime(true) - $start;
echo "Response: $response\n";
echo "Time elapsed: $elapsed seconds\n\n";

// Insert some dummy data into the collection
$embeddings = [
    [0.1, 0.2, 0.3],
    [0.4, 0.5, 0.6],
    [0.7, 0.8, 0.9]
];
$metadatas = [
    ['id' => 1, 'name' => 'embedding 1'],
    ['id' => 2, 'name' => 'embedding 2'],
    ['id' => 3, 'name' => 'embedding 3']
];
$documents = [
    'This is the document for embedding 1',
    'This is the document for embedding 2',
    'This is the document for embedding 3'
];
$ids = ['id1', 'id2', 'id3'];
$incrementIndex = true;
echo "Inserting dummy data into collection '$collectionName'...\n";
$start = microtime(true);
$response = $client->addEmbedding($collectionName, $embeddings, $metadatas, $documents, $ids, $incrementIndex);
$elapsed = microtime(true) - $start;
echo "Response: $response\n";
echo "Time elapsed: $elapsed seconds\n\n";

// Query for all embeddings in the collection
$where = null;
$whereDocument = null;
$sort = null;
$limit = null;
$offset = null;
$include = [];
echo "Querying for all embeddings in collection '$collectionName'...\n";
$start = microtime(true);
$response = $client->getEmbedding($collectionName, null, $where, $whereDocument, $sort, $limit, $offset, $include);
$elapsed = microtime(true) - $start;
echo "Response: $response\n";
echo "Time elapsed: $elapsed seconds\n\n";

// Query for nearest neighbors of a query embedding
$queryEmbeddings = [[0.2, 0.3, 0.4]];
$nResults = 2;
$include = [];
echo "Querying for nearest neighbors of query embedding in collection '$collectionName'...\n";
$start = microtime(true);
$response = $client->getNearestNeighbors($collectionName, $queryEmbeddings, $nResults, $include);
$elapsed = microtime(true) - $start;
echo "Response: $response\n";
echo "Time elapsed: $elapsed seconds\n\n";

// Clean up by deleting the collection
echo "Deleting collection '$collectionName'...\n";
$start = microtime(true);
$response = $client->deleteCollection($collectionName);
$elapsed = microtime(true) - $start;
echo "Response: $response\n";
echo "Time elapsed: $elapsed seconds\n\n";
