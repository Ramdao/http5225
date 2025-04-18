@extends('layout')

@section('content')
<div class="min-vh-100 py-5" style="background: linear-gradient(to bottom right, #1f1f1f, #3a3a3a); color: #fff;">
    <div class="container">
        <h1 class="text-center mb-5 text-info">All Cats</h1>
        <div style="padding:10px;">
        <a href="cats/create" class="btn btn-outline-info btn-sm">Add Cat</a> 
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($cats as $cat)
                <div class="col">
                    <div class="card text-white bg-dark h-100 shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">{{ $cat->name }}</h5>
                            <p class="card-text">Age: {{ $cat->age }}</p>
                            <p class="card-text">Likes: {{ $cat->likes }}</p>
                            <p class="card-text">
                                Breeds:
                                @foreach ($cat->breeds as $breed)
                                    <span class="badge bg-info text-dark">{{ $breed->name }}</span>
                                @endforeach
                            </p>
                        </div>
                        <!-- edit -->
                        <div class="card-footer bg-transparent d-flex justify-content-between">
                            <a href="{{ route('cats.edit', $cat->id) }}" class="btn btn-outline-info btn-sm">Edit</a>
                        <!-- delete -->
                            <form action="{{ route('cats.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this cat?');">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-outline-danger btn-sm">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const breedPersonalities = {
            'Siamese': 'Vocal and social.',
            'Maine Coon': 'Gentle and playful.',
            'Persian': 'Laid-back and affectionate.',
            'Bengal': 'Energetic and curious.',
            'Ragdoll': 'Relaxed and loving.'
        };

        // For each card
        document.querySelectorAll('.card').forEach(card => {
            const breedBadges = card.querySelectorAll('.badge');
            let added = false;

            breedBadges.forEach(badge => {
                const breedName = badge.textContent.trim();
                const personality = breedPersonalities[breedName];

                if (personality && !added) {
                    const p = document.createElement('p');
                    p.classList.add('card-text');
                    p.innerHTML = `<strong>Personality:</strong> ${personality}`;
                    card.querySelector('.card-body').appendChild(p);
                    added = true; 
                }
            });
        });
    });
</script>