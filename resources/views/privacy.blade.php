@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-8 mt-6 mb-12">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Privacy Policy</h1>
    <p class="text-gray-600 mb-8">
        CampusStay values your privacy. This policy explains how we collect, use, and protect your personal information.
    </p>

    <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-3">1. Information We Collect</h2>
    <ul class="list-disc list-inside text-gray-600 mb-4">
        <li>Personal details such as name, email, phone number, and role (student or landlord).</li>
        <li>Property information submitted by landlords.</li>
        <li>Usage data including login activity, preferences, and interactions with listings.</li>
    </ul>

    <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-3">2. How We Use Your Information</h2>
    <p class="text-gray-600 mb-4">
        We use your information to provide and improve our services, including:
    </p>
    <ul class="list-disc list-inside text-gray-600 mb-4">
        <li>Connecting students with landlords.</li>
        <li>Managing property listings and requests.</li>
        <li>Sending notifications and updates related to your account.</li>
    </ul>

    <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-3">3. Data Sharing</h2>
    <p class="text-gray-600 mb-4">
        We do not sell or rent your personal information. Data may be shared only:
    </p>
    <ul class="list-disc list-inside text-gray-600 mb-4">
        <li>With service providers who help us operate CampusStay.</li>
        <li>When required by law or to protect our legal rights.</li>
    </ul>

    <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-3">4. Security</h2>
    <p class="text-gray-600 mb-4">
        We implement appropriate technical and organizational measures to protect your data from unauthorized access, alteration, or disclosure.
    </p>

    <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-3">5. Cookies</h2>
    <p class="text-gray-600 mb-4">
        CampusStay may use cookies to enhance your browsing experience. You can disable cookies in your browser settings, but some features may not function properly.
    </p>

    <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-3">6. Your Rights</h2>
    <ul class="list-disc list-inside text-gray-600 mb-4">
        <li>You can access and update your personal information at any time.</li>
        <li>You may request deletion of your account and associated data.</li>
        <li>You can opt out of non-essential communications.</li>
    </ul>

    <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-3">7. Changes to This Policy</h2>
    <p class="text-gray-600 mb-4">
        We may update this Privacy Policy from time to time. Any changes will be posted here, and continued use of CampusStay indicates acceptance of the updated policy.
    </p>

    <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-3">8. Contact Us</h2>
    <p class="text-gray-600 mb-4">
        If you have questions about this Privacy Policy, please contact us at
        <a href="mailto:support@campusstay.com" class="text-blue-600 hover:underline">support@campusstay.com</a>.
    </p>
</div>
@endsection
