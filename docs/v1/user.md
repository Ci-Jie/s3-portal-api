# User API Reference Guide

1. [Create a Account](#CreateAccount)
2. [Auth Login](#AuthLogin)
3. [Check Email](#CheckEmail)
4. [Logout](#Logout)
5. [Check Ceph Connected](#CheckCephConnected)
6. [Get User Quota](#GetUserQuota)
7. [List Buckets](#ListBuckets)
8. [Create Bucket](#CreateBucket)
9. [Delete Bucket](#DeleteBucket)
10. [List Files](#ListFiles)
11. [Upload File](#UploadFile)
12. [Download File](#DownloadFile)
13. [Delete File](#DeleteFile)
14. [Rename File](#RenameFile)
15. [Move File](#MoveFile)
16. [Replicate File](#ReplicateFile)
17. [Create Folder](#CreateFolder)
18. [Delete Folder](#DeleteFolder)
19. [Rename Folder](#RenameFolder)
20. [Move Folder](#MoveFolder)

## 1. <a name="CreateAccount">Create a Account</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">POST</td>
        <td style="width:350px">/api/v1/auth/register</td>
    </tr>
</table>

### Input Parameter

<table>
    <tr>
        <td style="width:50px">Type</td>
        <td style="width:150px">Name</td>
        <td style="width:50px">Require</td>
        <td style="width:100px">Remark</td>
    </tr>
    <tr>
        <td style="width:50px">Email</td>
        <td style="width:150px">email</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">password</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">password_confirmation</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
</table>

### JSON Response
#### Success
```
status code: 200
{
	"tenant": *tenant*,
	"user_id": *user_id*,
	"display_name": *display_name*,
	"email": *email*,
	"suspended": *suspended*,
	"max_buckets": *max_buckets*
	"subusers": [],
	"keys": [
		{
			"user": *user*,
			"access_key": *access_key*,
			"secret_key": *secret_key*
		}
	],
	"swift_keys": [],
	"caps": [
		{
			"type": *type*,
			"perm": *perm*
		},
		...
	]
}
```

#### Error
```
status code: 403
{
	"message": "The user is exist",
}
- or -
status code: 401
{
	"message": "curl_has_error",
}
```

## 2. <a name="AuthLogin">Auth Login</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">POST</td>
        <td style="width:350px">/api/v1/auth/login</td>
    </tr>
</table>

### Input Parameter

<table>
    <tr>
        <td style="width:50px">Type</td>
        <td style="width:150px">Name</td>
        <td style="width:50px">Require</td>
        <td style="width:100px">Remark</td>
    </tr>
    <tr>
        <td style="width:50px">Email</td>
        <td style="width:150px">email</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">password</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
</table>

### JSON Response
#### Success
```
status code: 200
{
	"id": *id*,
	"uid": *uid*,
	"name": *name*,
	"role": *role*,
	"email": *email*,
	"access_key": *access_key*,
	"secret_key": *secret_key*,
	"created_at": *createTime*,
	"updated_at": *updateTime*,
	"token": *token*
}
```

#### Error
```
status code: 401
{
	"message": "The email is not exist"
}
```

## 3. <a name="CheckEmail">CheckEmail</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">GET</td>
        <td style="width:350px">/api/v1/auth/checkEmail/{email}</td>
    </tr>
</table>

### Input Parameter

<table>
    <tr>
        <td style="width:50px">Type</td>
        <td style="width:150px">Name</td>
        <td style="width:50px">Require</td>
        <td style="width:100px">Remark</td>
    </tr>
    <tr>
        <td style="width:50px">Email</td>
        <td style="width:150px">email</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
</table>

### JSON Response
#### Success
```
status code: 200
{
	"message": "You can use the email"
}
```

#### Error
```
status code: 403
{
	"message": "The email is exist"
}
```

## 4. <a name="Logout">Logout</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">POST</td>
        <td style="width:350px">/api/v1/logout</td>
    </tr>
</table>


### JSON Response
#### Success
```
status code: 200
{
	"message": "Logout is successfully"
}
```

#### Error
```
status code: 401
{
	"message": "Logout is failed"
}
```

## 5. <a name="CheckCephConnected">Check Ceph Connected</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">GET</td>
        <td style="width:350px">/api/v1/auth/checkCephConneted</td>
    </tr>
</table>

### JSON Response
#### Success
```
status code: 200
{
	"message": "Connected to Ceph success"
}
```

#### Error
```
status code: 403
{
	"message": "Connection to Ceph failed"
}
```

## 6. <a name="GetUserQuota">Get User Quota</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">GET</td>
        <td style="width:350px">/api/v1/auth/getUserQuota/{email}</td>
    </tr>
</table>

### JSON Response
#### Success
```
status code: 200
{
	"enabled": *true | false*,
	"check_on_raw": *true | false*,
	"max_size": *max_size*,
	"max_size_kb": * max_size_kb | -1*,
	"max_objects": * max_objects | -1*
}

note: if value is -1, there is no limit
```

#### Error
```
status code: 403
{
	"message": "The user is not exist"
}
```

## 7. <a name="ListBuckets">List Buckets</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">GET</td>
        <td style="width:350px">/api/v1/bucket/list</td>
    </tr>
</table>

### JSON Response
#### Success
```
status code: 200
{
	"Buckets": [
		{
			"Name": *Name*,
			"CreationDate": *CreationDate*
		}
		...
	]
}
```

#### Error
```
status code: 403
{
	"message": "List bucket is failed"
}
```

## 8. <a name="CreateBucket">Create Bucket</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">POST</td>
        <td style="width:350px">/api/v1/bucket/create</td>
    </tr>
</table>

### Input Parameter

<table>
    <tr>
        <td style="width:50px">Type</td>
        <td style="width:150px">Name</td>
        <td style="width:50px">Require</td>
        <td style="width:100px">Remark</td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">bucket</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
</table>

### JSON Response
#### Success
```
status code: 200
{
	"Buckets": [
		{
			"Name": *Name*,
			"CreationDate": *CreationDate*
		}
		...
	]
}
```

#### Error
```
status code: 403
{
	"message": "The bucket name is invalid"
}
- or -
status code: 403
{
	"message": "The bucket name is exist"
}
- or -
status code: 403
{
	"message": "Create bucket is failed"
}
```

## 9. <a name="DeleteBucket">Delete Buckets</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">DELETE</td>
        <td style="width:350px">/api/v1/bucket/delete/{bucket}</td>
    </tr>
</table>

### Input Parameter

<table>
    <tr>
        <td style="width:50px">Type</td>
        <td style="width:150px">Name</td>
        <td style="width:50px">Require</td>
        <td style="width:100px">Remark</td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">bucket</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
</table>

### JSON Response
#### Success
```
status code:200
{
	"message": "Delete bucket is successfully"
}
```

#### Error
```
status code: 403
{
	"message": "The Bucket is not exist"
}
- or -
status code: 403
{
	"message": "Delete bucket is failed"
}
```

## 10. <a name="ListFiles">List Files</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">GET</td>
        <td style="width:350px">/api/v1/file/list/{bucket}</td>
    </tr>
</table>


### JSON Response
#### Success
```
status code: 200
{
	"files": [
		{
			"Key": *Key*,
			"LastModified": *LastModified*,
			"ETag": "*Etag*",
			"Size": "*Size*",
			"StorageClass": "STANDARD",
			"Owner": {
				"ID": "*ID*",
				"DisplayName": "*Displayname*"
			}
		}
		...
	]
}
```

#### Error
```
status code: 403
{
	"message": "The bucket is not exist"
}
- or -
status code: 403
{
	"message": "List files is failed"
}
```

## 11. <a name="UploadFile">Upload File</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">POST</td>
        <td style="width:350px">/api/v1/file/create</td>
    </tr>
</table>

### Input Parameter

<table>
    <tr>
        <td style="width:50px">Type</td>
        <td style="width:150px">Name</td>
        <td style="width:50px">Require</td>
        <td style="width:100px">Remark</td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">bucket</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
    <tr>
        <td style="width:50px">File</td>
        <td style="width:150px">file</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">prefix</td>
        <td style="width:50px"></td>
        <td style="width:100px"></td>
    </tr>
</table>

### JSON Response

#### Success
```
status code: 200
{
	"message": "Upload file is successfully"
}
```
#### Error
```
status code: 403
{
  "message": "The bucket is not exist"
}
- or -
status code: 403
{
  "message": "Upload file is failed"
}
```

## 12. <a name="DownloadFile">Download File</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">GET</td>
        <td style="width:350px">/api/v1/file/get/{bucket}/{key}</td>
    </tr>
</table>

### JSON Response

#### Success

```
status code: 200

< Download file >
```

#### Error
```
status code: 403
{
  "message": "The bucket is not exist"
}
- or -
status code: 403
{
  "message": "Download file is failed"
}
```

## 13. <a name="DeleteFile">Delete File</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">DELETE</td>
        <td style="width:350px">/api/v1/file/delete/{bucket}/{key}</td>
    </tr>
</table>

### JSON Response
#### Success
```
status code: 200
{
  "message": "Delete file is successfully"
}
```

#### Error
```
status code:403
{
	"message": "The bucket is not exist"
}
- or -
status code:403
{
	"message": "The file is not exist"
}
- or -
status code:403
{
	"message": "Delete file is failed"
}
```

## 14. <a name="RenameFile">Rename File</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">POST</td>
        <td style="width:350px">/api/v1/file/rename</td>
    </tr>
</table>

### Input Parameter

<table>
    <tr>
        <td style="width:50px">Type</td>
        <td style="width:150px">Name</td>
        <td style="width:50px">Require</td>
        <td style="width:100px">Remark</td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">bucket</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">old</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">new</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
</table>

### JSON Response
#### Success
```
status code: 200
{
	"message": "Rename file is Successfully"
}
```

#### Error
```
status code: 403
{
	"message": "The bucket is not exist"
}
- or -
status code: 403
{
	"message": "The file of old name is not exist"
}
- or -
status code: 403
{
	"message": "The file of new name is exist"
}
- or -
status code: 403
{
	"message": "Rename file is failed"
}
```

## 15. <a name="MoveFile">Move File</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">POST</td>
        <td style="width:350px">/api/v1/file/move</td>
    </tr>
</table>

### Input Parameter

<table>
    <tr>
        <td style="width:50px">Type</td>
        <td style="width:150px">Name</td>
        <td style="width:50px">Require</td>
        <td style="width:100px">Remark</td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">sourceBucket</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">sourceFile</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
    <tr>
        <td style="width:50px"> String </td>
        <td style="width:150px">goalBucket</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">goalFile</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
</table>


### JSON Response
#### Success
```
status code: 200
{
	"message": "Move file is successfully"
}
```

#### Error
```
status code: 403
{
	"message": "The bucket of source is not exist"
}
- or -
status code: 403
{
	"message": "The bucket of goal is not exist"
}
- or -
status code: 403
{
	"message": "The file of source is not exist in source bucket"
}
- or -
status code: 403
{
	"message": "The file of goal is exist in goal bucket"
}
- or -
status code: 403
{
	"message": "Move file is failed"
}

```

## 16. <a name="ReplicateFile">Replicate File</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">POST</td>
        <td style="width:350px">/api/v1/file/replicate</td>
    </tr>
</table>

### Input Parameter

<table>
    <tr>
        <td style="width:50px">Type</td>
        <td style="width:150px">Name</td>
        <td style="width:50px">Require</td>
        <td style="width:100px">Remark</td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">bucket</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">file</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
</table>


### JSON Response
#### Success
```
status code: 200
{
	"message": "Replication is successfully"
}
```

#### Error
```
status code: 403
{
	"message": "The bucket is not exist"
}
- or -
status code: 403
{
	"message": "The file is not exist"
}
- or -
status code: 403
{
	"message": "The replicas is exist"
}
- or -
status code: 403
{
	"message": "Replication is failed"
}

```

## 17. <a name="CreateFolder">Create Folder</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">POST</td>
        <td style="width:350px">/api/v1/folder/create</td>
    </tr>
</table>

### Input Parameter

<table>
    <tr>
        <td style="width:50px">Type</td>
        <td style="width:150px">Name</td>
        <td style="width:50px">Require</td>
        <td style="width:100px">Remark</td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">bucket</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">prefix</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
</table>

### JSON Response
#### Success
```
status code: 200
{
	"message": "Create folder is Successfully"
}
```

#### Error
```
status code: 403
{
	"message": "The bucket is not exist"
}
- or -
status code: 403
{
	"message": "The folder is exist"
}
- or -
status code: 403
{
	"message": "Create folder is failed"
}
```

## 18. <a name="DeleteFolder">Delete Folder</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">DELETE</td>
        <td style="width:350px">/api/v1/folder/delete/{bucket}/{key}</td>
    </tr>
</table>

### JSON Response
#### Success
```
status code: 200
{
	"message": "Delete folder is successfully"
}
```

#### Error
```
status code: 403
{
	"message": "The bucket is not exist"
}
- or -
status code: 403
{
	"message": "The folder is not exist"
}
- or -
status code: 403
{
	"message": "Delete folder is failed"
}
```

## 19. <a name="RenameFolder">Rename Folder</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">POST</td>
        <td style="width:350px">/api/v1/folder/rename</td>
    </tr>
</table>

### Input Parameter

<table>
    <tr>
        <td style="width:50px">Type</td>
        <td style="width:150px">Name</td>
        <td style="width:50px">Require</td>
        <td style="width:100px">Remark</td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">bucket</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">oldName</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
        <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">newName</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
</table>


### JSON Response
#### Success
```
status code: 200
{
	"message": "The renamed is successfully"
}
```

#### Error
```
status code: 403
{
	"message": "The bucket is not exist"
}
- or -
status code: 403
{
	"message": "The old name is not exist"
}
- or -
status code: 403
{
	"message": "The new name is exist"
}
- or -
status code: 403
{
	"message": "The renamed is failed"
}

```

## 20. <a name="MoveFolder">Move Folder</a>

<table>
    <tr>
        <td style="width:50px">Method</td>
        <td style="width:350px">URI</td>
    </tr>
    <tr>
        <td style="width:50px">POST</td>
        <td style="width:350px">/api/v1/folder/move</td>
    </tr>
</table>

### Input Parameter

<table>
    <tr>
        <td style="width:50px">Type</td>
        <td style="width:150px">Name</td>
        <td style="width:50px">Require</td>
        <td style="width:100px">Remark</td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">sourceBucket</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
    <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">sourceFolder</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
        <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">goalBucket</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
    </tr>
        <tr>
        <td style="width:50px">String</td>
        <td style="width:150px">goalFolder</td>
        <td style="width:50px">✔︎</td>
        <td style="width:100px"></td>
    </tr>
</table>


### JSON Response
#### Success
```
status code: 200
{
	"message": "The Move is complete"
}
```

#### Error
```
status code: 403
{
	"message": "The bucket of source is not exist"
}
- or -
status code: 403
{
	"message": "The bucket of goal is not exist"
}
- or -
status code: 403
{
	"message": "The folder of source is not exist"
}
- or -
status code: 403
{
	"message": "The folder of goal is exist"
}
- or -
status code: 403
{
	"message": "The move is failed"
}

```
