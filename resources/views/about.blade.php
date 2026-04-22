<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - QuizSystem</title>
    @vite('resources/css/app.css')
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 40%, #ec4899 100%);
        }
    </style>
</head>
<body class="bg-slate-50 flex flex-col min-h-screen">

    <x-usernavbar></x-usernavbar>

    <!-- Hero Section -->
    <div class="hero-bg text-white py-16 px-6 text-center">
        <div class="max-w-3xl mx-auto">
            <div class="text-5xl mb-4">🧠</div>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">About QuizSystem</h1>
            <p class="text-indigo-100 text-lg">Your ultimate platform for testing knowledge and earning certificates</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto w-full px-6 py-12 flex-1">

        <!-- Mission Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                QuizSystem is dedicated to providing an accessible and engaging platform for learners worldwide to test their knowledge, 
                track their progress, and earn certificates that validate their skills.
            </p>
            <p class="text-gray-600 leading-relaxed">
                We believe that learning should be fun, interactive, and rewarding. Our platform offers a wide range of quizzes 
                across multiple categories, designed to challenge and inspire learners of all levels.
            </p>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center text-2xl mb-4">📚</div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Multiple Categories</h3>
                <p class="text-gray-600 text-sm">
                    Explore quizzes across various subjects and topics, from science and technology to arts and general knowledge.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="w-12 h-12 rounded-xl bg-violet-100 flex items-center justify-center text-2xl mb-4">🏆</div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Earn Certificates</h3>
                <p class="text-gray-600 text-sm">
                    Successfully complete quizzes and earn downloadable certificates to showcase your achievements.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="w-12 h-12 rounded-xl bg-pink-100 flex items-center justify-center text-2xl mb-4">📊</div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Track Progress</h3>
                <p class="text-gray-600 text-sm">
                    Monitor your quiz history, view detailed results, and track your learning journey over time.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-2xl mb-4">🆓</div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Free Access</h3>
                <p class="text-gray-600 text-sm">
                    All quizzes and features are completely free. No hidden costs, no subscriptions required.
                </p>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Why Choose QuizSystem?</h2>
            <ul class="space-y-3">
                <li class="flex items-start gap-3">
                    <span class="text-indigo-500 font-bold">✓</span>
                    <span class="text-gray-600">User-friendly interface designed for seamless learning experience</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-indigo-500 font-bold">✓</span>
                    <span class="text-gray-600">Regularly updated quiz content to keep you challenged</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-indigo-500 font-bold">✓</span>
                    <span class="text-gray-600">Instant results and detailed feedback on your performance</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-indigo-500 font-bold">✓</span>
                    <span class="text-gray-600">Secure and private - your data is protected</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-indigo-500 font-bold">✓</span>
                    <span class="text-gray-600">Mobile-responsive design - learn anywhere, anytime</span>
                </li>
            </ul>
        </div>

        <!-- CTA Section -->
        <div class="text-center bg-gradient-to-r from-indigo-50 to-pink-50 rounded-2xl p-8 border border-indigo-100">
            <h2 class="text-2xl font-bold text-gray-800 mb-3">Ready to Test Your Knowledge?</h2>
            <p class="text-gray-600 mb-6">Join thousands of learners and start your quiz journey today!</p>
            <div class="flex gap-3 justify-center flex-wrap">
                <a href="/user_signup" class="bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white px-6 py-3 rounded-xl font-semibold transition shadow">
                    Sign Up Now
                </a>
                <a href="/" class="bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 px-6 py-3 rounded-xl font-semibold transition">
                    Browse Quizzes
                </a>
            </div>
        </div>

    </div>

    <x-userfooter></x-userfooter>
</body>
</html>
