function Convert-Markdown-PHPSymbol {
    param (
        [Parameter(Mandatory = $false, ValueFromPipeline = $true)]
        [string]$Value = ""
    )

    process {
        $Value -replace '`\$([^`]+?)`', '<var>\$$$1</var>' | Write-Output
    }
}

function Build-TagAnchor {
    param (
        [string]$Href
    )

    return @"
    <a id="anchor-$Href" class="anchor" aria-hidden="true" href="#$Href">
        <svg class="octicon octicon-link" aria-hidden="true" height=16 version="1.1" viewBox="0 0 16 16" width=16>
            <path fill-rule="evenodd" d="M7.775 3.275a.75.75 0 001.06 1.06l1.25-1.25a2 2 0 112.83 2.83l-2.5 2.5a2 2 0 01-2.83 0 .75.75 0 00-1.06 1.06 3.5 3.5 0 004.95 0l2.5-2.5a3.5 3.5 0 00-4.95-4.95l-1.25 1.25zm-4.69 9.64a2 2 0 010-2.83l2.5-2.5a2 2 0 012.83 0 .75.75 0 001.06-1.06 3.5 3.5 0 00-4.95 0l-2.5 2.5a3.5 3.5 0 004.95 4.95l1.25-1.25a.75.75 0 00-1.06-1.06l-1.25 1.25a2 2 0 01-2.83 0z"></path>
        </svg>
    </a>
"@

}

function Build-Admonitions {
    param (
        [string]$Value
    )

    process {
        $Value -replace '(^|\n)>[ \t]\*\*Note\*\*(.*)(\n|$)', `
            '><span class="color-fg-accent"><svg class="octicon mr-2" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hiddent="true"> <path fill-rule="evenodd" d="M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8zm6.5-.25A.75.75 0 017.25 7h1a.75.75 0 01.75.75v2.75h.25a.75.75 0 010 1.5h-2a.75.75 0 010-1.5h.25v-2h-.25a.75.75 0 01-.75-.75zM8 6a1 1 0 100-2 1 1 0 000 2z"></path></svg></span>$2$3' `
               -replace '(^|\n)>[ \t]\*\*Warning\*\*(.*)(\n|$)', '><span class="color-fg-attention"><svg class="octicon octicon-alert mr-2" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hiddent="true">
            <path fill-rule="evenodd" d="M8.22 1.754a.25.25 0 00-.44 0L1.698 13.132a.25.25 0 00.22.368h12.164a.25.25 0 00.22-.368L8.22 1.754zm-1.763-.707c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0114.082 15H1.918a1.75 1.75 0 01-1.543-2.575L6.457 1.047zM9 11a1 1 0 11-2 0 1 1 0 012 0zm-.25-5.25a.75.75 0 00-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"></path>
        </svg>$2</span>$3' `
               -replace '(^|\n)>[ \t]\*\*Tip\*\*(.*)(\n|$)', '><span class="color-fg-success"><svg class="octicon octicon-danger mr-2" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hiddent="true">
               <path fill-rule="evenodd" d="M8 1.5c-2.363 0-4 1.69-4 3.75 0 .984.424 1.625.984 2.304l.214.253c.223.264.47.556.673.848.284.411.537.896.621 1.49a.75.75 0 0 1-1.484.211c-.04-.282-.163-.547-.37-.847a8.456 8.456 0 0 0-.542-.68c-.084-.1-.173-.205-.268-.32C3.201 7.75 2.5 6.766 2.5 5.25 2.5 2.31 4.863 0 8 0s5.5 2.31 5.5 5.25c0 1.516-.701 2.5-1.328 3.259-.095.115-.184.22-.268.319-.207.245-.383.453-.541.681-.208.3-.33.565-.37.847a.751.751 0 0 1-1.485-.212c.084-.593.337-1.078.621-1.489.203-.292.45-.584.673-.848.075-.088.147-.173.213-.253.561-.679.985-1.32.985-2.304 0-2.06-1.637-3.75-4-3.75ZM5.75 12h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1 0-1.5ZM6 15.25a.75.75 0 0 1 .75-.75h2.5a.75.75 0 0 1 0 1.5h-2.5a.75.75 0 0 1-.75-.75Z"></path>
        </svg></span>$2$3' `
               -replace '(^|\n)>[ \t]\*\*Important\*\*(.*)(\n|$)', '><span class="color-fg-danger"><svg class="octicon octicon-danger mr-2" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hiddent="true">
               <path fill-rule="evenodd" d="M4.47.22A.749.749 0 0 1 5 0h6c.199 0 .389.079.53.22l4.25 4.25c.141.14.22.331.22.53v6a.749.749 0 0 1-.22.53l-4.25 4.25A.749.749 0 0 1 11 16H5a.749.749 0 0 1-.53-.22L.22 11.53A.749.749 0 0 1 0 11V5c0-.199.079-.389.22-.53Zm.84 1.28L1.5 5.31v5.38l3.81 3.81h5.38l3.81-3.81V5.31L10.69 1.5ZM8 4a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 8 4Zm0 8a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"></path>
        </svg>$2</span>$3' `
                | Write-Output
    }
}

function Build-Markdown {
    param (
        [Parameter(Mandatory = $false, ValueFromPipeline = $true)]
        [string]$Value = ""
    )

    process {
        $Value = Build-Admonitions $Value
        $Value = $Value -replace '(^|\n)\.(.*)', '<span class="code-caption">$2</span>'

        [System.Web.HttpUtility]::HtmlDecode(
            [System.Web.HttpUtility]::HtmlEncode($Value)
        ) | ConvertFrom-Markdown | % { $_.Html.Trim() } | Write-Output
    }
}

function Build-MarkdownInline {
    param (
        [Parameter(Mandatory = $false, ValueFromPipeline = $true)]
        [string]$Value = ""
    )

    process {
        $md = Build-Markdown $Value
        if ($md -ne "") {
            $md = $md.Substring(3, $md.Length - 4)
        }
        $md | Write-Output
    }
}


function Build-DocPredicate {
    param (
        [Parameter(Mandatory=$true)]
        [string]$Name,
        [string]$Signature = '(mixed $value): bool',
        [string]$Disclaimer,
        [string]$ReturnClause,
        [string]$Body = '',
        [string[]]$Tags,
        [string[]]$Related,
        [string]$Examples,
        [switch]$ExampleOpen
    )

    $ReturnClause =  $ReturnClause | Convert-Markdown-PHPSymbol | Build-MarkdownInline
    $Disclaimer = $Disclaimer | Convert-Markdown-PHPSymbol | Build-MarkdownInline

    $html = "<dt id=""" + $Name.ToLower() + """>$Name&nbsp;"
    $html += Build-TagAnchor -Href $Name

    if ($Tags) {
        $html += '<ul class="tags">'

        foreach ($Tag in $Tags) {
            $Tag = $Tag.Trim().ToLower();
            $data_tag = ""

            if ($Tag.Trim().ToLower().StartsWith("extn:")) {
                $data_tag = "extn"
                $Tag = $Tag -replace 'extn:\s*', ''
                $html += "<li class=""tooltipped tooltipped-n"" data-tag=""$data_tag"" aria-label=""Requires php $Tag extension"">$Tag</li>"
            }
            else {
                $data_tag = $Tag
                $html += "<li data-tag=""$data_tag"">$Tag</li>"
            }

        }

        $html += "</ul>"
    }

    $html += "</dt><dd><code>$Name$Signature</code>"

    if ($Disclaimer) {
        $html += "<span>— $Disclaimer</span>"
    }

    $html += "<p class=""return"">$ReturnClause</p>"
    $html += $Body | Convert-Markdown-PHPSymbol | Build-Markdown
    $html += "</dd>"

    if ($Examples) {
        $Examples = $Examples | Build-Markdown

        $open = ""

        if ($ExampleOpen) { $open = "open" }

        $html += @"
    <dd class="examples">
        <details $open class="highlight highlight-text-html-php notranslate overflow-auto position-relative">
            <summary>Examples</summary>
"@

        $html += "$Examples</details></dd>"
    }

    if ($Related) {
        $html += '<dd class="related"><p>Related:</p><ul>'

        foreach ($Pred in $Related) {
            $html += '<li><a href="#' + $Pred.ToLower() + '">' + $Pred.ToLower() + '</a></li>'
        }

        $html += "</ul></dd>"
    }

    return $html
}

function Build-DocConstant {
    param (
        [Parameter(Mandatory = $true)]
        [string]$Name,
        [Parameter(Mandatory = $true)]
        [string]$Value,
        [string]$DataType = '',
        [string]$Body = '',
        [string[]]$Tags
    )

    $html = "<dt id=""const-" + $Name.ToLower() + """>$($Name.ToUpper())&nbsp;"
    $html += Build-TagAnchor -Href "const-$($Name.ToLower())"

    if ($Tags) {
        $html += '<ul class="tags">'

        foreach ($Tag in $Tags) {
            $Tag = $Tag.Trim().ToLower();
            $data_tag = ""

            if ($Tag.Trim().ToLower().StartsWith("extn:")) {
                $data_tag = "extn"
                $Tag = $Tag -replace 'extn:\s*', ''
                $html += "<li class=""tooltipped tooltipped-n"" data-tag=""$data_tag"" aria-label=""Requires php $Tag extension"">$Tag</li>"
            }
            else {
                $data_tag = $Tag
                $html += "<li data-tag=""$data_tag"">$Tag</li>"
            }

        }

        $html += "</ul>"
    }

    if ($DataType -ne '') {
        $DataType = "&lt;$DataType&gt;"
    }

    $html += "<dd>$DataType $Value</dd>"

    if ($Body) {
        $html += "<dd>"
        $html += $Body | Convert-Markdown-PHPSymbol | Build-Markdown
        $html += "</dd>"
    }

    return $html
}