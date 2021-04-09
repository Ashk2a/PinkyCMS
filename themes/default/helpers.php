<?php

function checkRecursive(int $rec, int $maxRec = 1000): void
{
    if ($rec > $maxRec) {
        // EXCEPTION
        dd('out');
    }
}

function isActiveMenuItem($item, int $rec = 0): bool
{
    checkRecursive($rec);

    if (!is_array($item)) {
        return false;
    }

    $currentPage = request()->path();

    if (isset($item['redirect']) && $item['redirect'] === $currentPage) {
        return false;
    }

    if (isset($item['page']) && $item['page'] === $currentPage) {
        return true;
    }

    foreach ($item as $each) {
        if (isActiveMenuItem($each, $rec++)) {
            return true;
        }
    }

    return false;

}


function renderMenuHeader(?array $item = [], ?array $parent = [], int $rec = 0): void
{
    checkRecursive($rec);

    if (null === $item) {
        dd('fuck');
    }

    // item
    $separator = $item['separator'] ?? null;
    $title = $item['title'] ?? null;
    $toggle = $item['toggle'] ?? null;
    $redirect = $item['redirect'] ?? null;
    $root = $item['root'] ?? null;
    $align = $item['align'] ?? null;
    $customClass = $item['custom-class'] ?? null;
    $iconOnly = $item['icon-only'] ?? null;
    $heading = $item['heading'] ?? null;
    $arrow = $item['arrow'] ?? null;
    $bullet = $item['bullet'] ?? null;
    $link = $item['link'] ?? null;
    $route = $item['route'] ?? null;
    $newTab = $item['new-tab'] ?? null;
    $here = $item['here'] ?? null;
    $icon = $item['icon'] ?? null;

    // itemLabel
    $label = $item['label'] ?? null;
    $labelType = ($label) ? $label['type'] ?? null : null;
    $labelValue = ($label) ? $labe['value'] ?? null : null;

    // itemSubmenu
    $subMenu = $item['submenu'] ?? null;
    $subMenuType = ($subMenu) ? $subMenu['type'] ?? null : null;
    $subMenuItems = ($subMenu) ? $subMenu['items'] ?? null : null;
    $submenuAlignment = ($subMenu) ? $subMenu['alignment'] ?? null : null;
    $subMenuWidth = ($subMenu) ? $subMenu['width'] ?? 0 : 0;
    $subMenuPull = ($subMenu) ? $subMenu['pull'] ?? null : null;
    $subMenuColumns = ($subMenu) ? $subMenu['columns'] ?? [] : [];

    // parent
    $parentBullet = $parent['bullet'] ?? null;

    if ($separator) {
        echo '<li class="menu-separator"><span></span></li>';
    } elseif ($title) {
        $itemClasses = '';
        $itemAttributes = '';

        if ($subMenu && isActiveMenuItem($item)) {
            $itemClasses .= ' menu-item-open menu-item-here';

            if ($subMenuType === 'tabs') {
                $itemClasses .= ' menu-item-active-tab ';
            }
        } elseif (isActiveMenuItem($item)) {
            $itemClasses .= ' menu-item-active ';
        }

        if ($subMenu) {
            $itemClasses .= ' menu-item-submenu'; // m-menu__item--active

            if ($toggle == 'click') {
                $itemAttributes .= ' data-menu-toggle="click"';
            } elseif ($subMenuType === 'tabs') {
                $itemAttributes .= ' data-menu-toggle="tab"';
            } else {
                $itemAttributes .= ' data-menu-toggle="hover"';
            }

            if (null === $subMenuType) {
                // default option
                $subMenuType = 'classic';
                $submenuAlignment = 'right';
            }
            if ($subMenuType === 'classic' && null !== $root) {
                $itemClasses .= ' menu-item-rel';
            }

            if ($subMenuType === 'mega' && null !== $root && $align !== 'center') {
                $itemClasses .= ' menu-item-rel';
            }

            if ($subMenuType === 'tabs') {
                $itemClasses .= ' menu-item-tabs';
            }
        }

        if ($redirect === true) {
            $itemAttributes .= ' data-menu-redirect="1"';
        }

        if ($subMenuItems && isActiveMenuItem($subMenu, $rec)) {
            $itemClasses .= ' menu-item-open menu-item-here'; // m-menu__item--active
        }

        if ($customClass) {
            $itemClasses .= ' ' . $customClass;
        }

        if ($iconOnly === true) {
            $itemClasses .= ' menu-item-icon-only';
        }

        if (null === $heading) {
            echo '<li class="menu-item ' . $itemClasses . '" ' . $itemAttributes . ' aria-haspopup="true">';
        }

        // insert title or heading
        if (null === $heading) {
            $url = '#';

            // TODO: UPDATE
            if (null !== $link) {
                $url = url($link);
            }

            $target = '';
            if ($newTab === true) {
                $target = 'target="_blank"';
            }

            echo '<a ' . $target . ' href="' . $url . '" class="menu-link ' . ($subMenu ? 'menu-toggle' : '') . '">';
        } else {
            echo '<h3 class="menu-heading menu-toggle">';
        }

        // put root level arrow
        if ($here === true) {
            echo '<span class="menu-item-here"></span>';
        }

        // bullet
        $bulletType = '';

        if ((null !== $heading && $bullet === 'dot') || $bullet === 'dot') {
            $bulletType = 'dot';
        } elseif ((null !== $heading && $bullet === 'line') || $parentBullet === 'line') {
            $bulletType = 'line';
        }

        // Menu icon OR bullet
        if ($bulletType === 'dot') {
            echo '<i class="menu-bullet menu-bullet-dot"><span></span></i>';
        } elseif ($bulletType == 'line') {
            echo '<i class="menu-bullet menu-bullet-line"><span></span></i>';
        } elseif (!empty($icon)) {
            // TODO: render icon
        }

        // Badge
        echo '<span class="menu-text">' . $title . '</span>';
        if (null !== $label) {
            echo '<span class="menu-badge"><span class="label ' . $labelType . '">' . $labelValue . '</span></span>';
        }
        // Arrow
        if (null !== $subMenu && (null === $arrow || false === $arrow)) {
            // root down arrow
            echo '<i class="menu-hor-arrow"></i>';
            echo '<i class="menu-arrow"></i>';
        }

        // closing title or heading
        if (null === $heading) {
            echo '</a>';
        } else {
            echo '<i class="menu-arrow"></i></h3>';
        }

        if (null !== $subMenu && is_array($subMenuType)) {
            if (in_array($subMenuType, ['classic', 'tabs'])) {
                $subMenuClasses = '';

                if (null !== $submenuAlignment) {
                    $subMenuClasses .= ' menu-submenu-' . $submenuAlignment;

                    if (isset($item['submenu']['pull']) && $subMenuPull == true) {
                        $subMenuClasses .= ' menu-submenu-pull';
                    }
                }

                if ($subMenuType === 'tabs') {
                    $subMenuClasses .= ' menu-submenu-tabs';
                }

                echo '<div class="menu-submenu menu-submenu-classic' . $subMenuClasses . '">';
                echo '<ul class="menu-subnav">';

                if (null !== $subMenuItems) {
                    $items = $subMenuItems;
                } else {
                    $items = $subMenu;
                }
                foreach ($items as $subMenuItem) {
                    renderMenuHeader($subMenuItem, $item, $rec++);
                }

                echo '</ul>';
                echo '</div>';
            } elseif ($subMenuType === 'mega') {
                $subMenuFixedWidth = '';

                if ($subMenuWidth > 0) {
                    $subMenuClasses = ' menu-submenu-fixed';
                    $subMenuFixedWidth = 'style="width:' . $subMenuWidth . '"';
                } else {
                    $subMenuClasses = ' menu-submenu-' . $subMenuWidth;
                }

                if (null !== $submenuAlignment) {
                    $subMenuClasses .= ' menu-submenu-' . $submenuAlignment;

                    if (true === $subMenuPull) {
                        $subMenuClasses .= ' menu-submenu-pull';
                    }
                }

                echo '<div class="menu-submenu ' . $subMenuClasses . '" ' . ($subMenuFixedWidth) . '>';

                echo '<div class="menu-subnav">';
                echo '<ul class="menu-content">';
                foreach ($subMenuColumns as $column) {
                    $itemClasses = '';
                    // mega menu column header active
                    if (isset($column['items']) && isActiveMenuItem($column)) {
                        $itemClasses .= ' menu-item-open menu-item-here'; // m-menu__item--active
                    }

                    echo '<li class="menu-item ' . $itemClasses . '">';
                    if (isset($column['heading'])) {
                        renderMenuHeader($column['heading'], null, $rec++);
                    }
                    echo '<ul class="menu-inner">';
                    foreach ($column['items'] as $column_submenu_item) {
                        renderMenuHeader($column_submenu_item, $column, $rec++);
                    }
                    echo '</ul>';
                    echo '</li>';
                }
                echo '</ul>';
                echo '</div>';
                echo '</div>';
            }
        }


        if (false === $heading) {
            echo '</li>';
        }
    } elseif (is_array($item)) {
        foreach ($item as $each) {
            renderMenuHeader($each, $parent, $rec++);
        }
    }
}
