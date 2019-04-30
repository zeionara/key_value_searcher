# key_value_searcher
Handler of requests for values, accessible by keys and located in an external file.
## Request a value by key  
Query example  
```
curl http://localhost/kvs/app/ -d 'key=TL&filename=../documents/test.txt'
```  
Result  
```json
{
   "key" : "TL",
   "value" : "LT"
}
```
## Run test
Query example
```
curl http://localhost/kvs/test/ -d 'echo_execution_time=true&number_of_keys_to_generate=10000&number_of_keys_to_test=5,filename=../documents/test.txt'
```
Result
```json
{
   "file_generated" : true,
   "request_incorrect_keys" : {
      "{{" : {
         "search_time" : 0.00256705284118652,
         "value" : null
      }
   },
   "request_correct_keys" : {
      "CWX" : {
         "search_time" : 0.00261807441711426,
         "value" : "XWC"
      },
      "DUL" : {
         "search_time" : 0.00237894058227539,
         "value" : "LUD"
      },
      "DVk" : {
         "search_time" : 0.00206398963928223,
         "value" : "kVD"
      },
      "CXQ" : {
         "value" : "QXC",
         "search_time" : 0.00236606597900391
      },
      "S" : {
         "search_time" : 0.00220894813537598,
         "value" : "S"
      }
   }
}
```
