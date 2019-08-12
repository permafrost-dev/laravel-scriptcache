## Laravel ScriptCache
---

This package allows javascript to leverage the laravel cache and store small amounts of data for a limited amount of time, usually 60 seconds.

## Installation

You can install the package via composer:

```bash
composer require permafrost-dev/laravel-scriptcache
```

## Usage

``` javascript

    async function setCachedData(value) {
        const token = await axios.get('/api/scriptcache?data=' + value);
        return token;
    }

    async function getCachedData(token) {
        const result = (await axios.get('/api/scriptcache/'+token));
        return result;
    }

    async function doSomeDataProcessing(dataStr) {
        const token = (await setCachedData(dataStr)).data;
        const cacheid = token.cache_id;

        const cachedDataObject = (await getCachedData(cacheid)).data;
        const cachedData = cachedDataObject.data;

        console.log('original data: ', dataStr);
        console.log('got cached data: ', cachedData);
    }
    
    //...cache expires after 60 seconds
```

### Notes
---

The cached data is sanitized prior to storage, and the cache key used is tied to the requesting user to avoid access to other items in the cache.


### Testing

``` bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.