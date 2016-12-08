<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;

class CreateFolderTest extends TestCase
{
    /**
     * The base Headers to use while testing the AuthLoginTest Class.
     *
     * @var array
     */
    protected $headers = [
        'HTTP_Accept' => 'application/json'
    ];
    /**
     * The base PostData to use while testing the AuthLoginTest Class.
     *
     * @var array
     */
    protected $postData = [
        'email' => 'ApiTestEmail@yahoo.com.tw',
        'password' => 'ApiTestPassword'
    ];
    public function createBucket($user, $bucketName)
    {
        $s3Service = new  \App\Services\BucketService($user['access_key'], $user['secret_key']);
        $s3Service->createBucket($bucketName);
    }
    public function initBucketAndGetToken()
    {
        $bucketName = str_random(10);
        $user = $this->createUser($this->postData['email'], $this->postData['password'], true);
        $token = \JWTAuth::fromUser($user);
        $this->createBucket($user, $bucketName);
        return ['bucketName' => $bucketName, 'token' => $token, 'user' => $user];
    }
    public function testCreateFolderSuccess()
    {
        $init = $this->initBucketAndGetToken();
        $headers = $this->headers;
        $headers['HTTP_Authorization'] = "Bearer {$init['token']}";
        $bucketName = $init['bucketName'];
        $postData = [
            'bucket' => $bucketName,
            'prefix' => str_random(15)
        ];
        $this->post('/api/v1/folder/create', $postData, $headers)
            ->seeStatusCode(200)
            ->seeJsonContains([
                "message" => "Create Folder Success"
            ]);
    }
    public function testCreateFolderFailed()
    {
        $init = $this->initBucketAndGetToken();
        $headers = $this->headers;
        $headers['HTTP_Authorization'] = "Bearer {$init['token']}";
        $bucketName = str_random(15);
        $postData = [
            'bucket' => $bucketName,
            'prefix' => str_random(15)
        ];
        $this->post('/api/v1/folder/create', $postData, $headers)
            ->seeStatusCode(403)
            ->seeJsonContains([
                "message" => "Bucket not Exist"
            ]);
    }
}