## Please visit our [API-Explorer](https://tippindev.com/api-explorer) for the most up to date data.

### GET `/api/messenger/threads/{thread}/audio` | *api.messenger.threads.audio.index*
#### Response:
```json
{
  "data": [
    {
      "id": "92315377-0a5c-47ed-928e-45670dd6c341",
      "thread_id": "923135d4-bcaa-4aa7-83a9-cc9765866b19",
      "owner_id": "922f8476-bdda-4ebd-b283-be23602c658d",
      "owner_type": "App\\Models\\User",
      "owner": {
        "name": "John Doe",
        "route": null,
        "provider_id": "922f8476-bdda-4ebd-b283-be23602c658d",
        "provider_alias": "user",
        "base": {
          "id": "922f8476-bdda-4ebd-b283-be23602c658d",
          "name": "John Doe",
          "avatar": "img_5fcee7c1e64404.55920965.jpg",
          "created_at": "2020-12-07T07:57:14.000000Z",
          "updated_at": "2020-12-08T05:39:08.000000Z"
        },
        "avatar": {
          "sm": "/messenger/assets/provider/user/922f8476-bdda-4ebd-b283-be23602c658d/sm/img_5fcee7c1e64404.55920965.jpg",
          "md": "/messenger/assets/provider/user/922f8476-bdda-4ebd-b283-be23602c658d/md/img_5fcee7c1e64404.55920965.jpg",
          "lg": "/messenger/assets/provider/user/922f8476-bdda-4ebd-b283-be23602c658d/lg/img_5fcee7c1e64404.55920965.jpg"
        }
      },
      "type": 3,
      "type_verbose": "AUDIO_MESSAGE",
      "system_message": false,
      "body": "test_1607405513.mp3",
      "edited": false,
      "embeds": false,
      "extra": null,
      "reacted": false,
      "created_at": "2020-12-08T05:31:53.000000Z",
      "updated_at": "2020-12-08T05:31:53.000000Z",
      "meta": {
        "thread_id": "923135d4-bcaa-4aa7-83a9-cc9765866b19",
        "thread_type": 1,
        "thread_type_verbose": "PRIVATE"
      },
      "audio": "/messenger/assets/threads/923135d4-bcaa-4aa7-83a9-cc9765866b19/audio/92315377-0a5c-47ed-928e-45670dd6c341/test_1607405513.mp3"
    }
  ],
  "meta": {
    "index": true,
    "page_id": null,
    "next_page_id": null,
    "next_page_route": null,
    "final_page": true,
    "per_page": 50,
    "results": 1,
    "total": 1
  }
}
```
---
### POST `/api/messenger/threads/{thread}/audio` | *api.messenger.threads.audio.store*
#### Payload:
```json
{
  "audio" : "(binary)",
  "temporary_id" : "adb9c9b0-3916-11eb-985e-e58d0602db52",
  "reply_to_id" : "nullable|string",
  "extra" : "nullable|array|json"
}
```
#### Response:
```json
{
  "id": "92315377-0a5c-47ed-928e-45670dd6c341",
  "thread_id": "923135d4-bcaa-4aa7-83a9-cc9765866b19",
  "owner_id": "922f8476-bdda-4ebd-b283-be23602c658d",
  "owner_type": "App\\Models\\User",
  "owner": {
    "name": "John Doe",
    "route": null,
    "provider_id": "922f8476-bdda-4ebd-b283-be23602c658d",
    "provider_alias": "user",
    "base": {
      "id": "922f8476-bdda-4ebd-b283-be23602c658d",
      "name": "John Doe",
      "avatar": "img_5fcee7c1e64404.55920965.jpg",
      "created_at": "2020-12-07T07:57:14.000000Z",
      "updated_at": "2020-12-08T05:31:08.000000Z"
    },
    "avatar": {
      "sm": "/messenger/assets/provider/user/922f8476-bdda-4ebd-b283-be23602c658d/sm/img_5fcee7c1e64404.55920965.jpg",
      "md": "/messenger/assets/provider/user/922f8476-bdda-4ebd-b283-be23602c658d/md/img_5fcee7c1e64404.55920965.jpg",
      "lg": "/messenger/assets/provider/user/922f8476-bdda-4ebd-b283-be23602c658d/lg/img_5fcee7c1e64404.55920965.jpg"
    }
  },
  "type": 3,
  "type_verbose": "AUDIO_MESSAGE",
  "system_message": false,
  "body": "test_1607405513.mp3",
  "edited": false,
  "embeds": false,
  "extra": null,
  "reacted": false,
  "created_at": "2020-12-08T05:31:53.000000Z",
  "updated_at": "2020-12-08T05:31:53.000000Z",
  "meta": {
    "thread_id": "923135d4-bcaa-4aa7-83a9-cc9765866b19",
    "thread_type": 1,
    "thread_type_verbose": "PRIVATE"
  },
  "temporary_id": "adb9c9b0-3916-11eb-985e-e58d0602db52",
  "audio": "/messenger/assets/threads/923135d4-bcaa-4aa7-83a9-cc9765866b19/audio/92315377-0a5c-47ed-928e-45670dd6c341/test_1607405513.mp3"
}
```