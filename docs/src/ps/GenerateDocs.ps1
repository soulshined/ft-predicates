$ErrorActionPreference = 'Stop'

. './DocBuilders.ps1'

# Predicates
$PredDirs = (Get-ChildItem ./predicates)

$Predicates = @{}

foreach ($Dir in $PredDirs) {
    $Predicates[$Dir.BaseName] = @()

    $docs = Get-ChildItem $Dir -Filter *.ps1 -Recurse

    foreach ($doc in $docs) {
        $Predicates[$Dir.BaseName] += (. $doc);
    }
}

$PredsOrder = @(
    @{ Name = 'callbacks'; Value = 'Callbacks'},
    @{ Name = 'general'; Value = 'General' },
    @{ Name = 'platform'; Value = 'Platform' },
    @{ Name = 'php'; Value = 'PHP' },
    @{ Name = 'server'; Value = 'Server' },
    @{ Name = 'numbers'; Value = 'Numbers' },
    @{ Name = 'strings'; Value = 'Strings' },
    @{ Name = 'dates'; Value = 'Dates' }
)

$fthtml = ""
foreach ($o in $PredsOrder) {
    $anchor = Build-TagAnchor $o.Name

    $fthtml += @"
    h3 (data-predicate-category="$($o.Value)") {
        "$($anchor -replace '"', '\"')"
        "$($o.Value)"
    }
    dl(data-predicate-category="$($o.Value)") "$($Predicates[$o.Name] -replace '"', '\"')"
"@
}

$fthtml | Out-File ../imports/predicates/all.fthtml

# Constants

$ConstDirs = (Get-ChildItem ./constants)

$Constants = @{}

foreach ($Dir in $ConstDirs) {
    $Constants[$Dir.BaseName] = @()

    $docs = Get-ChildItem $Dir -Filter *.ps1 -Recurse

    foreach ($doc in $docs) {
        $Constants[$Dir.BaseName] += (. $doc);
    }
}

$ConstsOrder = @(
    @{ Name = 'numbers'; Value = 'Numbers' },
    @{ Name = 'dates'; Value = 'Dates' }
)

$fthtml = ""
foreach ($o in $ConstsOrder) {
    $fthtml += @"
    h3 (data-constant-category="$($o.Value)") "$($o.Value)"
    dl(data-constant-category="$($o.Value)") "$($Constants[$o.Name] -replace '"', '\"')"
"@
}

$fthtml | Out-File ../imports/constants/all.fthtml

$MiscFiles = @('ft.ini.ps1', 'localization.ps1');

foreach ($File in $MiscFiles) {
    $fthtml = "div { """
    $fthtml += ((. (Get-ChildItem $File)) | Build-Markdown) -replace '"', '\"'
    $fthtml += """ }"

    $target = $File -replace ".ps1$", ""
    $fthtml | Out-File "../imports/$target/main.fthtml"
}