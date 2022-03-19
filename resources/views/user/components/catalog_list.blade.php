<div class="catalog-list" id="navigation-menu">
    <ul>
        <li>
            <a href="#section-main">Tổng quan</a>
        </li>
        @foreach ($project->project_catalogs as $catalog)
            <li>
                <a data-ps2id-offset="150" href="#section-{{ $catalog->id }}">{{ $catalog->name }}</a>
            </li>
        @endforeach
        @if (!$project->project_images->isEmpty())
        <li>
            <a data-ps2id-offset="100" href="#section-image">Hình ảnh</a>
        </li>
        @endif

    </ul>
</div>
