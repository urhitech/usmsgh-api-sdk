# Upgrade Guide

## Upgrading from 1.x to 2.0

### PHP Version Requirement

Version 2.0 requires **PHP 8.0 or later**. If you're still using PHP 7.x, you'll need to upgrade your PHP version before updating this package.

### Laravel Version Support

Version 2.0 supports Laravel 8.x, 9.x, 10.x, and 11.x. Make sure your Laravel application is running one of these versions.

### Breaking Changes

#### 1. `sendSms()` Return Value

**Before (v1.x):**
```php
$result = $client->sendSms($endpoint, $api_token, $sender_id, $phones, $message);
// Returns: false
```

**After (v2.0):**
```php
$result = $client->sendSms($endpoint, $api_token, $sender_id, $phones, $message);
// Returns: array with API response or error information
// Example: ['status' => 'success', 'message_id' => '...'] or ['error' => 'Error message']
```

**Migration:**
- Check for errors by looking for the `error` key in the response array
- Use the response data to get message IDs and status information

#### 2. Service Configuration Key

**Before (v1.x):**
```php
// config/services.php
'all_my_sms' => [
    'endpoint' => env('USMSGH_ENDPOINT'),
    // ...
]
```

**After (v2.0):**
```php
// config/services.php
'usmsgh' => [
    'sender_endpoint' => env('USMSGH_ENDPOINT'),  // Note: 'endpoint' → 'sender_endpoint'
    'api_token' => env('USMSGH_API_TOKEN'),
    'sender_id' => env('USMSGH_SENDER'),
    'universal_to' => env('USMSGH_UNIVERSAL_TO'),
]
```

#### 3. Namespace and Class Names

**Before (v1.x):**
```php
use Urhitech\Umsmgh\UsmsChannel;  // Typo in namespace
use Urhitech\Umsmgh\UsmsMessage;
```

**After (v2.0):**
```php
use Urhitech\Usmsgh\UsmsChannel;  // Corrected namespace
use Urhitech\Usmsgh\UsmsMessage;
```

#### 4. Error Handling in Notifications

**Before (v1.x):**
The code would throw an error when trying to call `getStatusCode()` on a non-response object.

**After (v2.0):**
```php
// Errors are now properly caught and thrown as CouldNotSendNotification exceptions
try {
    $user->notify(new SmsNotification($message));
} catch (CouldNotSendNotification $e) {
    // Handle the error
    Log::error('SMS failed: ' . $e->getMessage());
}
```

### Non-Breaking Changes

These changes improve code quality but don't require any action on your part:

- All methods now have proper type declarations
- Improved error responses with structured arrays
- Better code consistency with strict comparisons
- Fixed internal static property access patterns

### Testing Your Upgrade

After upgrading, test the following:

1. **Send a single SMS:**
```php
$response = $client->sendSms($endpoint, $api_token, $sender_id, '233500000000', 'Test message');
if (isset($response['error'])) {
    // Handle error
} else {
    // Success
}
```

2. **Send to multiple recipients:**
```php
$response = $client->sendSms($endpoint, $api_token, $sender_id, '233500000000,233540000000', 'Test message');
// Response will be an array of responses for each recipient
```

3. **Use with Laravel Notifications:**
```php
$user->notify(new YourSmsNotification());
```

### Getting Help

If you encounter any issues during the upgrade:

1. Check the [CHANGELOG.md](CHANGELOG.md) for detailed information
2. Review your error logs for specific error messages
3. Open an issue on [GitHub](https://github.com/urhitech-enterprise/usmsgh-api-sdk)
