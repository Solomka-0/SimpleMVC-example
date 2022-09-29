<?php
function paginationPanel($count, $offset, $currentPage)
{
    # Вычисляет лимит
    $limit = ceil($count / $offset);
    # интервал пагинации
    $internalOffset = 2;

    # Переопределяет параметры для формы
    $routes = '';
    foreach ($_GET as $key => $parameter) {
        if ($key != "page") {
            $routes .= '<input type="hidden" name="' . $key . '" value="' . $parameter . '">';
        }
    }

    # Шапка
    $view = '<form style="align-self: start; margin-left: 20px">
        ' . $routes . '
        <div style="display: flex; flex-direction: row; grid-gap: 2px; align-items: center; background: #eaeaea; padding: 2px; border-radius: 8px; border: lightgrey solid 1px">
        ';

    # Находит значения панели около выбраной страницы
    $start = (($currentPage - $internalOffset) < 1) ? 1 : ($currentPage - $internalOffset);
    $end = (($currentPage + $internalOffset) > $limit) ? $limit : ($currentPage + $internalOffset);

    $pageValues = formGap($start, $end);

    # Находит начальные значения панели
    $pageValues = array_merge(formGap(1, $internalOffset > $limit ? $limit : $internalOffset), $pageValues);
    # Находит конечные значения панели
    $pageValues = array_merge($pageValues, formGap($limit - $internalOffset, $limit));

    # Убирает повторяющиеся значения
    $pageValues = array_unique($pageValues);

    # Если страница одна возвращает пустую панель пагинации
    if (count($pageValues) < 2) {
        return "";
    }

    # Формирует кнопочную структуру панели
    $view .= printOffsets($pageValues, $currentPage, $limit);

    # футтер
    $view .= '
        </div>
    </form>';
    return $view;
}

/**
 * @param int $start начало формируемого отрезка
 * @param int $end конец формируемого отрезка
 * @return array
 * Формирует отрезок значений заданного диапазона
 */
function formGap($start, $end)
{
    $arr = [];
    for ($i = $start; $i <= $end; $i++) {
        if ($i > 0) {
            $arr[] = $i;
        }
    }
    return $arr;
}

/**
 * @param array $values массив значений
 * @param int $currentPage выбранная страница
 * @param int $limit предел страниц
 * @return string
 * Возвращает кнопочную структуру панели пагинации
 */
function printOffsets($values, $currentPage, $limit)
{
    $view = '';
    $prev = 0;
    if ($currentPage > 1) {
        $view .= '<button name="page" value="' . ($currentPage - 1) .'" style="padding: 4px; border: 1px solid grey; min-width: 35px; min-height: 35px; text-align: center;
            border-radius: 4px;">' . '<<' . '</button>';
    }
    foreach ($values as $value) {
        if ($value - $prev > 1) {
            $view .= "<div style='margin-left: 4px; margin-right: 4px'>...</div>";
        }
        $prev = $value;

        $view .= '<button ' .($value == $currentPage ? 'disabled' : '') . ' name="page" value="' . $value.'" style="padding: 4px; border: 1px solid grey; min-width: 35px; min-height: 35px; text-align: center;
            border-radius: 4px;' . ($value == $currentPage ? 'color: white; background: grey; font-weight: bold;' : 'background: white') . '">' . $value . '</button>';
    }

    if ($currentPage < $limit) {
        $view .= '<button name="page" value="' . ($currentPage + 1) .'" style="padding: 4px; border: 1px solid grey; min-width: 35px; min-height: 35px; text-align: center;
            border-radius: 4px;">' . '>>' . '</button>';
    }
    return $view;
}
