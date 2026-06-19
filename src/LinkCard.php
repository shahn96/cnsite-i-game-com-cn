<?php

namespace App\Helpers;

/**
 * Generates a safe, escaped HTML card for a given link.
 * This is a static utility class; no external dependencies are required.
 */
final class LinkCardRenderer
{
    /**
     * Default card configuration.
     *
     * @var array
     */
    private static array $defaultConfig = [
        'site_name' => '爱游戏',
        'domain'    => 'https://cnsite-i-game.com.cn',
        'icon'      => '🎮',
        'color'     => '#2c3e50',
        'border'    => '1px solid #bdc3c7',
        'radius'    => '12px',
    ];

    /**
     * Generate a link card as an escaped HTML snippet.
     *
     * @param string $title   Card title (will be escaped)
     * @param string $url     Target URL (will be escaped)
     * @param string $description Short description (will be escaped)
     * @param array  $overrides   Optional config overrides (same keys as $defaultConfig)
     * @return string          Safe HTML string
     */
    public static function render(
        string $title,
        string $url,
        string $description = '',
        array  $overrides = []
    ): string {
        $config = array_merge(self::$defaultConfig, $overrides);

        $escapedTitle       = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedUrl         = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedSiteName    = htmlspecialchars($config['site_name'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedIcon        = htmlspecialchars($config['icon'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedColor       = htmlspecialchars($config['color'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedBorder      = htmlspecialchars($config['border'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedRadius      = htmlspecialchars($config['radius'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return <<<HTML
<div style="border:{$escapedBorder}; border-radius:{$escapedRadius}; padding:18px 22px; background:#f9f9f9; max-width:480px; font-family:system-ui, -apple-system, sans-serif; color:{$escapedColor};">
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
        <span style="font-size:1.8rem;">{$escapedIcon}</span>
        <div>
            <a href="{$escapedUrl}" style="font-weight:600; font-size:1.2rem; color:{$escapedColor}; text-decoration:none;" target="_blank" rel="noopener noreferrer">{$escapedTitle}</a>
            <div style="font-size:0.85rem; opacity:0.7; margin-top:2px;">{$escapedSiteName}</div>
        </div>
    </div>
    <p style="margin:8px 0 0 0; line-height:1.4; font-size:0.95rem;">{$escapedDescription}</p>
</div>
HTML;
    }

    /**
     * Render an example link card using the default site data.
     *
     * @return string Safe HTML
     */
    public static function renderDefault(): string
    {
        return self::render(
            title:       '爱游戏 — 娱乐平台',
            url:         'https://cnsite-i-game.com.cn',
            description: '发现精彩游戏，享受无限乐趣。爱游戏，让每一天都充满惊喜。'
        );
    }
}