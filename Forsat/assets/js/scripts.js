document.addEventListener('DOMContentLoaded', () => {
    // Existing typewriter effect
    const text = 'Here in Algeria to give you the best chance to find your own path while providing you the best candidates to work with. Make it easy, make it Forsat for you and us.';
    let index = 0;
    const speed = 50;
    const typewriter = document.getElementById('typewriter');

    function typeText() {
        if (typewriter && index < text.length) {
            typewriter.innerHTML += text[index];
            index++;
            setTimeout(typeText, speed);
        }
    }
    typeText();

    // New typewriter effect for Content2
    const text2 = 'Forsat connects talented individuals with exciting opportunities across Algeria and Africa. Our platform empowers both job seekers and employers, fostering growth and success in diverse industries.';
    let index2 = 0;
    const typewriter2 = document.getElementById('typewriter2');

    function typeText2() {
        if (typewriter2 && index2 < text2.length) {
            typewriter2.innerHTML += text2[index2];
            index2++;
            setTimeout(typeText2, speed);
        }
    }
    typeText2();
});

