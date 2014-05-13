# Github issue puller thingy

This poorly-named tool is a very quick hack designed to pull GitHub issues from a given repository into a CSV file.

## Dependencies

- PHP >= 5.4
- [Composer](https://getcomposer.org/)
- [knplabs/github-api](https://github.com/knplabs/github-api)
- [guzzle/guzzle](https://github.com/guzzle/guzzle)
- [league/csv](https://github.com/league/csv)

## Installation

Clone the repository down:

```bash
git clone git@github.com:kieranajp/github-issues.git
```

Install dependencies with Composer:

```bash
php composer.phar self-update
php composer.phar install
```

(If you have composer [installed into your path](https://getcomposer.org/doc/00-intro.md#globally) then you can omit the `php` and the `.phar`, obviously)

## Running it

```bash
php GithubIssues.php
```

And follow the instructions! It will output a CSV file named after the repo you target.

## License

MIT License (MIT)

Copyright (c) 2014 Kieran Patel

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
