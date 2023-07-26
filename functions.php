<?php declare(strict_types=1);

function debug(mixed $data): void
{
    $colors = [
    "RST" => "\e[0m",
    "RST_BOLD" => "\e[21m",
    "RST_DIM" => "\e[22m",
    "RST_UNDERLINE" => "\e[24m",
    "RST_BLINK" => "\e[25m",
    "RST_REVERSE" => "\e[27m",
    "RST_HIDDEN" => "\e[28m",
    "FX_BOLD" => "\e[001m",
    "FX_DIM" => "\e[002m",
    "FX_UNDERLINE" => "\e[004m",
    "FX_BLINK" => "\e[005m",
    "FX_REVERSE" => "\e[007m",
    "FX_HIDDEN" => "\e[008m",
    "FG_DEFAULT" => "\e[39m",
    "FG_BLACK" => "\e[30m",
    "FG_RED" => "\e[31m",
    "FG_GREEN" => "\e[32m",
    "FG_YELLOW" => "\e[33m",
    "FG_BLUE" => "\e[34m",
    "FG_MAGENTA" => "\e[35m",
    "FG_CYAN" => "\e[36m",
    "FG_LIGHT_GRAY" => "\e[37m",
    "FG_DARK_GRAY" => "\e[90m",
    "FG_LIGHT_RED" => "\e[91m",
    "FG_LIGHT_GREEN" => "\e[92m",
    "FG_LIGHT_YELLOW" => "\e[93m",
    "FG_LIGHT_BLUE" => "\e[94m",
    "FG_LIGHT_MAGENTA" => "\e[95m",
    "FG_LIGHT_CYAN" => "\e[96m",
    "FG_WHITE" => "\e[97m",
    "BG_DEFAULT" => "\e[49m",
    "BG_BLACK" => "\e[40m",
    "BG_RED" => "\e[41m",
    "BG_GREEN" => "\e[42m",
    "BG_YELLOW" => "\e[43m",
    "BG_BLUE" => "\e[44m",
    "BG_MAGENTA" => "\e[45m",
    "BG_CYAN" => "\e[46m",
    "BG_LIGHT_GRAY" => "\e[47m",
    "BG_DARK_GRAY" => "\e[100m",
    "BG_LIGHT_RED" => "\e[101m",
    "BG_LIGHT_GREEN" => "\e[102m",
    "BG_LIGHT_YELLOW" => "\e[103m",
    "BG_LIGHT_BLUE" => "\e[104m",
    "BG_LIGHT_MAGENTA" => "\e[105m",
    "BG_LIGHT_CYAN" => "\e[106m",
    "BG_WHITE" => "\e[107m"
    ];

    $colors["COLOR"] = $colors["BG_BLUE"];

    $stderr = fopen("php://stderr", "w");

    $data = var_export($data, true);
    $data = $colors["COLOR"] . "[debug]" . $colors["RST"] . PHP_EOL . $colors["COLOR"] . " " . $colors["RST"] . str_replace(PHP_EOL, PHP_EOL . $colors["COLOR"] . " " . $colors["RST"], $data);

    fwrite($stderr, $data . PHP_EOL . " ");
}
