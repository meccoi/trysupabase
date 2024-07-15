<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload and Display Image</title>
</head>

<body>
    <h1 class="text-6xl">Home</h1>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint consequuntur corporis nam sequi at? Deserunt distinctio nesciunt nam animi sit excepturi, cupiditate repellendus corrupti nobis tempore laudantium quasi, optio itaque.</p>

    <h1>Upload and Display Image</h1>
    <input type="file" id="fileInput" />
    <button id="uploadButton">Upload</button>
    <div id="imageContainer"></div>

    <!-- Include the Supabase client library from CDN -->
    <script type="module">
        import {
            createClient
        } from 'https://esm.sh/@supabase/supabase-js@2';

        const supabaseUrl = 'https://latvpxaukzytgsgctrrr.supabase.co';
        const supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImxhdHZweGF1a3p5dGdzZ2N0cnJyIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjA5NTUzNDMsImV4cCI6MjAzNjUzMTM0M30.7wWs6aIaLThkojZwqnjqH3kRr0cQ4ktJ6cMSwVqXPug';
        const supabase = createClient(supabaseUrl, supabaseKey);

        document.getElementById('uploadButton').addEventListener('click', async () => {
            const fileInput = document.getElementById('fileInput');
            const file = fileInput.files[0];
            if (!file) {
                alert('Please select a file first');
                return;
            }
            // https://latvpxaukzytgsgctrrr.supabase.co/storage/v1/object/public/gallery/Tulips.jpg
            try {
                // Upload image to Supabase storage
                const {
                    data,
                    error: uploadError
                } = await supabase.storage.from('gallery').upload('images/' + file.name, file);


                if (uploadError) {
                    console.error('Error uploading image:', uploadError.message);
                    alert('Error uploading image. Check console for details.');
                    return;
                } else {
                    alert("Successfully uploaded image");
                    console.log(data);
                    const url = `https://latvpxaukzytgsgctrrr.supabase.co/storage/v1/object/public/${data.fullPath}`;
                    const {
                        data: userData,
                        error: insertError
                    } = await supabase
                        .from('imageUrl')
                        .insert({
                            url
                        });

                    if (insertError) {
                        console.error('Error inserting data:', insertError.message);
                        alert('Error submitting form!');
                    } else {
                        alert('Form submitted successfully!');

                    }
                }

            } catch (error) {
                console.error('Error:', error.message);
                alert('An error occurred. Check console for details.');
            }
        });

        async function fetchImages() {
            try {
                const {
                    data,
                    error
                } = await supabase.from('imageUrl').select('*');
                if (error) {
                    throw error;
                }

                return data;
            } catch (error) {
                console.error('Error fetching images:', error.message);
                return [];
            }
        }


        fetchImages().then(images => {
            images.forEach(image => {
                console.log(image.url);

                if (image) {
                    let imageElement = document.createElement('img');
                    imageElement.src = image.url;

                    document.querySelector('#imageContainer').appendChild(imageElement);
                }
            });
        });

        fetchImages();
    </script>
</body>

</html>