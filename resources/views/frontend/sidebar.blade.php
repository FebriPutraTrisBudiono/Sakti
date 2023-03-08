<?php $sectionPosts = App\Models\Section::getSection('posts'); ?>
<div class="col-lg-4">
    @if ($sectionPosts)
        <div class="sidebar">
            <div class="sidebar-item search-form">
                <h3 class="sidebar-title">Cari Berita</h3>
                <form action="/posts" method="get" class="mt-3">
                    @if (request('category'))
                        <input type="hidden" name="category" id="category" value="{{ request('category') }}">
                    @endif

                    @if (request('author'))
                        <input type="hidden" name="author" id="author" value="{{ request('author') }}">
                    @endif
                    <input type="text" class="form-control" name="q" id="q" placeholder="Cari ..."
                        value="{{ request('q') }}">
                    <button type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <?php $posts = \App\Models\Post::with(['category', 'user'])
                ->latest()
                ->where('status', 1)
                ->paginate(5); ?>
            <div class="sidebar-item recent-posts">
                <h3 class="sidebar-title">Berita Terbaru</h3>
                <div class="mt-3">
                    @foreach ($posts as $row)
                        <div class="post-item mt-3">
                            @if ($row->image)
                                <img src="/storage/{{ $row->image }}" alt="{{ $row->title }}">
                            @endif
                            <div>
                                <h4><a href="/posts/{{ $row->slug }}">{{ $row->title }}</a></h4>
                                <time
                                    datetime="{{ date('Y-m-d', strtotime($row->created_at)) }}">{{ date('d/m/Y', strtotime($row->created_at)) }}</time>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <?php $categories = \App\Models\Category::orderBy('name', 'ASC')->get(); ?>
            <div class="sidebar-item categories">
                <h3 class="sidebar-title">Kategori Berita</h3>
                <ul class="mt-3">
                    @foreach ($categories as $row)
                        <li><a href="/posts?category={{ $row->slug }}">{{ $row->name }}
                                <span>({{ number_format($row->posts->where('status', 1)->count(), 0, '.', '.') }})</span></a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <?php $sectionPPID = \App\Models\Section::getSection('ppid'); ?>
            @if ($sectionPPID)
                <?php $ppid = \App\Http\Helpers\ApiPPID::getNews(); ?>
                <div class="sidebar-item recent-posts">
                    <h3 class="sidebar-title">Berita PPID</h3>
                    <div class="mt-3">
                        @foreach (array_slice($ppid, 0, 5) as $row)
                            <div class="post-item mt-3">
                                <img src="https://ppid.jemberkab.go.id/{{ str_replace('public/', 'storage/', $row['foto_berita']) }}"
                                    alt="{{ $row['judul_berita'] }}">
                                <div>
                                    <h4>
                                        <a href="https://ppid.jemberkab.go.id/berita-ppid/detail/{{ $row['slug'] }}"
                                            target="_blank">{{ $row['judul_berita'] }}</a>
                                    </h4>
                                    <time
                                        datetime="{{ date('Y-m-d', strtotime($row['created_at'])) }}">{{ date('d/m/Y', strtotime($row['created_at'])) }}</time>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>
