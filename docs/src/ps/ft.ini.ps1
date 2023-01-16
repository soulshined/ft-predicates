Write-Output @'

```
[predicates]
locale_id_strategy=<value>
locale_timezone_strategy=<value>
```

> **Important** The 'predicates' ini section is required as this file may be used across many `ft` packages

<dl>
<dt>locale_id_strategy</dt>
<dd>
<p>Default: <code>php_ini</code></p>
Possible Values:

<ul>
<li>php_ini — The locale is retrieved using <code>ini_get('intl.default_locale')</code></li>
<li>env_var — The locale is retrieved using <code>getenv('lang')</code></li>
<li>http_accept_header — The locale is retrieved using <code>$_SERVER['HTTP_ACCEPT']</code></li>
</ul>
</dd>

<dt>locale_timezone_strategy</dt>
<dd>
<p>Default: <code>none</code></p>
Possible Values:

<ul>
<li>none - <code>$null</code> will be used</li>
<li>php_ini — The timezone is retrieved using <code>ini_get('date.timezone')</code></li>
<li>env_var — The timezone is retrieved using <code>getenv('ft.predicates.default_timezone')</code></li>
</ul>
</dd>
</dl>


To let the package know you want it to use an ft.ini file simply call:

```
putenv("ft.ini=<ft.ini path>")
```
'@