# Changelog

All notable changes to `usmsgh` will be documented in this file

## 2.0.0 - 2024-12-11

### Added
- PHP 8.0, 8.1, 8.2, and 8.3 support
- Laravel 9.x, 10.x, and 11.x support
- Return type declarations on all methods
- Parameter type hints for improved type safety
- Better error handling with structured error responses

### Changed
- **Breaking:** Minimum PHP version is now 8.0 (was 7.0)
- **Breaking:** `sendSms()` now returns array instead of false
- Improved `sendSms()` method to return actual API responses
- Fixed static property access from `$this::` to `self::`
- Changed loose comparisons (`==`) to strict comparisons (`===`)
- Fixed class name inconsistency (USmsChannel → UsmsChannel)
- Updated all namespace references to use correct casing
- Improved error response structure for better debugging

### Fixed
- Bug in `UsmsChannel::send()` calling `getStatusCode()` on array/boolean
- Fixed `sendSingle()` method to return response instead of void
- Corrected all method signatures to include proper type declarations
- Fixed documentation errors and typos in README
- Fixed service provider configuration key naming

### Removed
- PHP 7.x support (use version 1.x for PHP 7 compatibility)

## 1.0.0 - 201X-XX-XX

- initial release
