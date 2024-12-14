<!-- start section of imges that hold a word that descripe its collection -->
<section class="collection">
    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-lg-4 col-md-12">
                    <a href="{{ route('site.category.show', $category->name) }}">
                        <div class="collection-pic">
                            <img src="{{ asset($category->image) }}" alt="banner-1">
                            <h4>{{ $category->name }}</h4>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- end section of imges that hold a word that descripe its collection -->
