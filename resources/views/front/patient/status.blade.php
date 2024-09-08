@extends('front.patient.layout.master')
@section('main_content')

<body>
	<div class="home-banner-section">
        <div class="container">
            <div class="banner-content">
            	<h1><span>{{ isset( $status ) && !empty( $status ) ? $status : 'Error' }}</span></h1>
				<h3>{{ isset( $msg ) && !empty( $msg ) ? $msg : 'Something thing went wrong!' }}</h3>
            </div>
        </div>
    </div>
</body>

@endsection