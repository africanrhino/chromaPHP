<?php 

class chromaPHP {
    private $baseUrl;
    
    public function __construct($baseUrl) {
        $this->baseUrl = $baseUrl;
    }

    private function sendRequest($method, $url, $data = []) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json'
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

public function deleteCollection($collectionName) {
    $url = $this->baseUrl . '/api/v1/collections/' . $collectionName;
    $response = $this->sendRequest('DELETE', $url);
    return $response;
}

    public function version() {
        return $this->sendRequest('GET', $this->baseUrl . '/api/v1/version', null);
    }

    public function createCollection($collectionName, $metadata, $getOrCreate) {
        $data = [
            'name' => $collectionName,
            'metadata' => $metadata,
            'get_or_create' => $getOrCreate
        ];
        return $this->sendRequest('POST', $this->baseUrl . '/api/v1/collections', $data);
    }

    public function addEmbedding($collectionName, $embeddings, $metadatas, $documents, $ids, $incrementIndex) {
        $data = [
            'embeddings' => $embeddings,
            'metadatas' => $metadatas,
            'documents' => $documents,
            'ids' => $ids,
            'increment_index' => $incrementIndex
        ];
        return $this->sendRequest('POST', $this->baseUrl . '/api/v1/collections/' . $collectionName . '/add', $data);
    }

    public function getEmbedding($collectionName, $ids, $where, $whereDocument, $sort, $limit, $offset, $include) {
        $data = [
            'ids' => $ids,
            'where' => $where,
            'where_document' => $whereDocument,
            'sort' => $sort,
            'limit' => $limit,
            'offset' => $offset,
            'include' => $include
        ];
        return $this->sendRequest('POST', $this->baseUrl . '/api/v1/collections/' . $collectionName . '/get', $data);
    }

    public function deleteEmbedding($collectionName, $ids, $where, $whereDocument) {
        $data = [
            'ids' => $ids,
            'where' => $where,
            'where_document' => $whereDocument
        ];
        return $this->sendRequest('POST', $this->baseUrl . '/api/v1/collections/' . $collectionName . '/delete', $data);
    }

    public function count($collectionName) {
        return $this->sendRequest('GET', $this->baseUrl . '/api/v1/collections/' . $collectionName . '/count', null);
    }

    public function reset() {
        return $this->sendRequest('POST', $this->baseUrl . '/api/v1/reset', null);
    }
        public function getNearestNeighbors($collectionName, $queryEmbeddings, $nResults, $include) {
            $data = [
                'query_embeddings' => $queryEmbeddings,
                'n_results' => $nResults,
                'include' => $include
            ];
            $response = $this->sendRequest('POST', $this->baseUrl . '/api/v1/collections/' . $collectionName . '/query', $data);
            return $response;
        }

    public function createIndex($collectionName) {
        return $this->sendRequest('POST', $this->baseUrl . '/api/v1/collections/' . $collectionName . '/create_index', null);
    }

    public function rawSql($rawSql) {
        $data = [
            'raw_sql' => $rawSql
        ];
        return $this->sendRequest('POST', $this->baseUrl . '/api/v1/raw_sql', $data);
    }

}
