# Release Guide for Version 2.0.0

## Pre-Push Checklist

### ✅ Completed
- [x] Updated `composer.json` with PHP 8.0+ and Laravel 8-11 support
- [x] Added version "2.0.0" to `composer.json`
- [x] Fixed all code issues (type hints, return types, bug fixes)
- [x] Updated README.md with correct information
- [x] Created comprehensive CHANGELOG.md
- [x] Created UPGRADE.md guide
- [x] Fixed badges in README.md
- [x] Updated .gitignore

### 📝 Before You Push

1. **Review all changes:**
   ```bash
   git status
   git diff
   ```

2. **Test locally (if possible):**
   - Run `composer validate` to check composer.json
   - Test in a Laravel project if available

## Git Commands to Push Updates

### Option 1: Push to Existing Branch (Recommended for Testing)

```bash
# Check current status
git status

# Stage all modified and new files
git add .

# Commit with descriptive message
git commit -m "Release v2.0.0: Modernize SDK for PHP 8.0+ and Laravel 8-11

- Update PHP requirement to 8.0+
- Add support for Laravel 9.x, 10.x, 11.x
- Add type hints and return types to all methods
- Fix critical bug in UsmsChannel response handling
- Improve error handling with structured responses
- Update documentation and create upgrade guide
- Fix namespace inconsistencies

BREAKING CHANGES:
- Minimum PHP version is now 8.0
- sendSms() now returns array instead of false
- Service configuration structure updated

See CHANGELOG.md and UPGRADE.md for details."

# Push to your branch (usually 'main' or 'master')
git push origin main
```

### Option 2: Create a Development Branch First (Safer Approach)

```bash
# Create and switch to a new branch
git checkout -b feature/v2-modernization

# Stage all changes
git add .

# Commit
git commit -m "Release v2.0.0: Modernize SDK for PHP 8.0+ and Laravel 8-11

Major updates:
- PHP 8.0+ with type safety
- Laravel 8-11 compatibility
- Bug fixes and improvements
- Complete documentation update

See CHANGELOG.md for full details."

# Push the new branch
git push origin feature/v2-modernization

# Then create a Pull Request on GitHub for review
```

### After Pushing to Main Branch

```bash
# Create a release tag
git tag -a v2.0.0 -m "Version 2.0.0 - Modern PHP 8 and Laravel 8-11 support"

# Push the tag to GitHub
git push origin v2.0.0
```

## GitHub Release Steps

1. **Go to GitHub Repository:**
   https://github.com/urhitech-enterprise/usmsgh-api-sdk

2. **Navigate to Releases:**
   - Click "Releases" on the right sidebar
   - Click "Create a new release"

3. **Fill in Release Details:**

   **Tag version:** v2.0.0
   
   **Release title:** v2.0.0 - Modern PHP 8 and Laravel 8-11 Support
   
   **Description:**
   ```markdown
   ## 🎉 Version 2.0.0 - Major Modernization Update
   
   This release brings the USMSGH SDK up to date with modern PHP and Laravel versions.
   
   ### ✨ What's New
   
   - **PHP 8.0+ Support** - Full compatibility with PHP 8.0, 8.1, 8.2, and 8.3
   - **Laravel 8-11 Support** - Works with Laravel 8.x, 9.x, 10.x, and 11.x
   - **Type Safety** - Complete type hints and return type declarations
   - **Better Error Handling** - Structured error responses for easier debugging
   
   ### 🐛 Bug Fixes
   
   - Fixed critical bug in `UsmsChannel` response handling
   - Fixed namespace inconsistencies
   - Improved `sendSms()` to return meaningful responses
   
   ### ⚠️ Breaking Changes
   
   - **Minimum PHP version is now 8.0** (was 7.0)
   - **`sendSms()` return value changed** from `false` to response array
   - **Service configuration updated** - see UPGRADE.md
   
   ### 📚 Documentation
   
   - [Upgrade Guide](UPGRADE.md) - How to migrate from v1.x
   - [Changelog](CHANGELOG.md) - Complete list of changes
   - [README](README.md) - Updated usage examples
   
   ### 🚀 Installation
   
   ```bash
   composer require usmsgh/usmsgh-api-sdk:^2.0
   ```
   
   ### 📖 Full Changelog
   
   See [CHANGELOG.md](CHANGELOG.md) for complete details.
   ```

4. **Publish Release:**
   - Check "Set as the latest release"
   - Click "Publish release"

## Packagist Update

If your package is registered on Packagist:

1. **Auto-update (if webhook configured):**
   - Packagist should auto-detect the new tag
   - Wait 5-10 minutes for it to update

2. **Manual update (if needed):**
   - Go to https://packagist.org/packages/usmsgh/usmsgh-api-sdk
   - Click "Update" button
   - Confirm the new version appears

## Post-Release Checklist

- [ ] Verify GitHub release is visible
- [ ] Check Packagist shows v2.0.0
- [ ] Test installation: `composer require usmsgh/usmsgh-api-sdk:^2.0`
- [ ] Update any related documentation or websites
- [ ] Announce the release (if applicable)
- [ ] Monitor GitHub issues for any problems

## Rollback Plan (If Needed)

If critical issues are found:

```bash
# Delete the tag locally
git tag -d v2.0.0

# Delete the tag remotely
git push origin :refs/tags/v2.0.0

# Delete the release on GitHub
# (Go to Releases → Edit → Delete)

# Create a hotfix branch
git checkout -b hotfix/v2.0.1
```

## Communication Template

For announcing the release:

```markdown
🎉 USMSGH API SDK v2.0.0 Released!

We're excited to announce v2.0.0 with full support for PHP 8.0+ and Laravel 8-11.

Key improvements:
✅ Modern PHP 8 support with type safety
✅ Compatible with Laravel 8, 9, 10, and 11
✅ Bug fixes and better error handling
✅ Comprehensive upgrade guide

⚠️ This is a major version with breaking changes. 
Please see our upgrade guide before updating: [link to UPGRADE.md]

Install: composer require usmsgh/usmsgh-api-sdk:^2.0

Full changelog: [link to CHANGELOG.md]
```

## Support

If users report issues:
1. Create GitHub issues for tracking
2. Respond promptly with workarounds
3. Prepare hotfix release if critical (v2.0.1)

---

## Quick Command Reference

```bash
# Check status
git status

# Stage and commit all changes
git add .
git commit -m "Your message"

# Push to main
git push origin main

# Create and push tag
git tag -a v2.0.0 -m "Version 2.0.0"
git push origin v2.0.0

# View remote branches
git branch -r

# View all tags
git tag -l
```
