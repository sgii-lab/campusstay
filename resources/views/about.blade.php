@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-8 mt-6 mb-12">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">About CampusStay</h1>
    <p class="text-gray-600 mb-8">
        CampusStay is a platform designed to simplify student housing in Zimbabwe.
        We connect students with trusted landlords, making the process of finding accommodation transparent, secure, and stress‑free.
    </p>

    <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-3">Our Mission</h2>
    <p class="text-gray-600 mb-4">
        To empower students by providing access to affordable, safe, and reliable housing options while supporting landlords with an easy‑to‑use system for managing their properties.
    </p>

    <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-3">Our Vision</h2>
    <p class="text-gray-600 mb-4">
        We envision a future where every student can focus on their education without worrying about accommodation challenges, and every landlord can reach the right tenants effortlessly.
    </p>

    <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-3">What We Offer</h2>
    <ul class="list-disc list-inside text-gray-600 mb-4">
        <li>Verified property listings with images, descriptions, and pricing.</li>
        <li>Direct communication between students and landlords via WhatsApp integration.</li>
        <li>Role‑based dashboards for students, landlords, and administrators.</li>
        <li>Secure authentication and data protection for all users.</li>
    </ul>

    <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-3">Why Choose CampusStay?</h2>
    <p class="text-gray-600 mb-4">
        Unlike traditional housing searches, CampusStay ensures transparency, reduces fraud, and streamlines the rental process.
        Our responsive design makes it easy to access the platform on any device, anytime.
    </p>

    <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-3">Contact Us</h2>
    <p class="text-gray-600 mb-4">
        Have questions or feedback? Reach out to us at
        <a href="mailto:support@campusstay.com" class="text-blue-600 hover:underline">support@campusstay.com</a>.
    </p>
</div>
@endsection
