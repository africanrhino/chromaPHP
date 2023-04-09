chromaPHP
=========

`chromaPHP` is a PHP client for [Chroma](https://github.com/chroma-core/chroma), the open-source embedding database. Chroma makes it easy to build LLM apps by making knowledge, facts, and skills pluggable for LLMs.

`chromaPHP` provides a simple way to interact with Chroma using PHP.

Requirements
------------

*   PHP 7.0 or later
*   The cURL extension for PHP

Installation
------------

You can install `chromaPHP` using [Composer](https://getcomposer.org/). Simply add the following to your `composer.json` file:

json

```json
{
    "require": {
        "yourname/chromaphp": "^1.0"
    }
}
```

Then run `composer install` to install the library and its dependencies.

Usage
-----

To use `chromaPHP`, you'll need to first create a client instance by passing in the base URL of your Chroma server:

php

```php
$client = new chromaPHP("http://localhost:8000");
```

You can then use the client object to perform various operations on your Chroma collections. Here's an example that demonstrates creating a collection, adding some embeddings to it, querying for nearest neighbors of a query embedding, and then deleting the collection:

php

```php
// Create a new collection
$collectionName = "my_collection";
$metadata = ["name" => "John", "age" => 30];
$getOrCreate = false;
echo "Creating collection '$collectionName'...\n";
$start = microtime(true);
$response = $client->createCollection($collectionName, $metadata, $getOrCreate);
$elapsed = microtime(true) - $start;
echo "Response: $response\n";
echo "Time elapsed: $elapsed seconds\n\n";

// Add embeddings to the collection
$embeddings = [[0.1, 0.2, 0.3], [0.4, 0.5, 0.6]];
$metadatas = [["name" => "Alice", "age" => 25], ["name" => "Bob", "age" => 40]];
$documents = ["document1", "document2"];
$ids = ["id1", "id2"];
$incrementIndex = false;
echo "Adding embeddings to collection '$collectionName'...\n";
$start = microtime(true);
$response = $client->addEmbedding($collectionName, $embeddings, $metadatas, $documents, $ids, $incrementIndex);
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
```

Note that the `chromaPHP` client provides methods for all of the operations supported by Chroma, including creating and deleting collections, adding embeddings, querying for nearest neighbors, and more.

Contributing
------------

Contributions are welcome! If you encounter any bugs or issues while using `chromaPHP`, please open an issue on the [GitHub repository](https://github.com/africanrhino/chromaphp) and we'll do our best to resolve it. If you would like to contribute a new feature or improvement, please open a pull request.
 
