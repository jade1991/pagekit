@if (pages)

<div class="uk-margin uk-text-muted uk-text-right">
    @count @transchoice("{0} Pages| {1} Page| ]1,Inf] Pages", count)
</div>

<table class="uk-table uk-table-hover uk-table-middle">
    <thead>
        <tr>
            <th class="pk-table-width-minimum"><input type="checkbox" class="js-select-all"></th>
            <th class="pk-table-min-width-100">@trans('Title')</th>
            <th class="pk-table-width-100 uk-text-center">@trans('Status')</th>
            <th class="pk-table-width-200 pk-table-min-width-200">@trans('URL')</th>
            <th class="pk-table-width-100">@trans('Access')</th>
        </tr>
    </thead>
    <tbody>
        @foreach (pages as page)
        <tr>
            <td>
                <input type="checkbox" name="ids[]" class="js-select" value="@page.id">
            </td>
            <td>
                <a href="@url.route('@page/page/edit', ['id' => page.id])">@page.title</a>
            </td>
            <td class="uk-text-center">
                <a href="#" data-action="@url.route('@page/page/status', ['ids[]' => page.id, 'status' => page.status ? '0' : '1'])" title="@page.statusText">
                    <i class="uk-icon-circle uk-text-@(page.status ? 'success' : 'danger')" title="@page.statusText"></i>
                </a>
            </td>
            <td class="pk-table-text-break">
                @set(link = url.route('@page/id', ['id' => page.id], 'base') ?: '/')
                @if (page.status == 1 && app.users.checkAccessLevel(page.accessId))
                <a href="@url.route('@page/id', ['id' => page.id])" target="_blank">@link|urldecode</a>
                @else
                @link
                @endif
            </td>
            <td>
                @(levels[page.accessId].name ?: trans('No access level'))
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif