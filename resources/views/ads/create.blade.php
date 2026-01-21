<x-app-layout>
    <x-slot name="title">Predaj novi oglas</x-slot>
    <x-slot name="description">Objavite svoj poslovni oglas besplatno. Ponudite ili potražite usluge, partnere i poslovne prilike na Poduzetnici.hr platformi.</x-slot>
    <x-slot name="robots">noindex, nofollow</x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    <div class="mb-8 text-center">
                        <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-blue-600">
                            Predaj novi oglas
                        </h1>
                        <p class="text-gray-500 mt-2">Ispunite obrazac ispod kako biste objavili svoju ponudu ili potražnju.</p>
                    </div>

                    <form method="POST" action="{{ route('ads.store') }}" class="space-y-8" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Naslov oglasa')" class="text-lg font-semibold text-gray-700" />
                            <x-text-input id="title" class="block mt-2 w-full p-4 border-gray-200 focus:border-primary-500 focus:ring-primary-500 rounded-xl shadow-sm bg-gray-50" type="text" name="title" :value="old('title')" placeholder="npr. Prodajem uhodan posao u centru" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Type -->
                            <div>
                                <span class="block text-lg font-semibold text-gray-700 mb-2">{{ __('Tip oglasa') }}</span>
                                <div class="flex space-x-4">
                                    <label class="flex-1 relative cursor-pointer group">
                                        <input type="radio" name="type" value="offer" class="peer sr-only" checked>
                                        <div class="p-4 rounded-xl border-2 border-gray-200 peer-checked:border-primary-500 peer-checked:bg-primary-50 hover:bg-gray-50 transition-all text-center">
                                            <span class="block font-bold text-gray-900 peer-checked:text-primary-700">Nudim</span>
                                        </div>
                                    </label>
                                    <label class="flex-1 relative cursor-pointer group">
                                        <input type="radio" name="type" value="demand" class="peer sr-only">
                                        <div class="p-4 rounded-xl border-2 border-gray-200 peer-checked:border-primary-500 peer-checked:bg-primary-50 hover:bg-gray-50 transition-all text-center">
                                            <span class="block font-bold text-gray-900 peer-checked:text-primary-700">Tražim</span>
                                        </div>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>

                            <!-- Category -->
                            <div>
                                <x-input-label for="category" :value="__('Kategorija')" class="text-lg font-semibold text-gray-700" />
                                <div class="relative mt-2">
                                    <select id="category" name="category" class="block w-full p-4 border-gray-200 focus:border-primary-500 focus:ring-primary-500 rounded-xl shadow-sm bg-gray-50 appearance-none">
                                        <option value="Prodaja poslovanja">Prodaja poslovanja</option>
                                        <option value="Partnerstva">Partnerstva</option>
                                        <option value="Oprema i alati">Oprema i alati</option>
                                        <option value="Usluge">Usluge</option>
                                        <option value="Oglasni prostor">Oglasni prostor</option>
                                        <option value="Pitanja i odgovori">Pitanja i odgovori</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>

                            <!-- Location -->
                            <div>
                                <x-input-label for="location" :value="__('Lokacija')" class="text-lg font-semibold text-gray-700" />
                                <x-text-input id="location" class="block mt-2 w-full p-4 border-gray-200 focus:border-primary-500 focus:ring-primary-500 rounded-xl shadow-sm bg-gray-50" type="text" name="location" :value="old('location')" placeholder="npr. Zagreb, Split..." required />
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Price -->
                            <div x-data="{ priceOnRequest: false }">
                                <div class="flex justify-between items-center mb-2">
                                    <x-input-label for="price" :value="__('Cijena (€)')" class="text-lg font-semibold text-gray-700" />

                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" x-model="priceOnRequest" class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-600 font-medium">Cijena na upit</span>
                                    </label>
                                </div>
                                <div class="relative">
                                    <x-text-input id="price" class="block w-full p-4 border-gray-200 focus:border-primary-500 focus:ring-primary-500 rounded-xl shadow-sm bg-gray-50 transition-colors disabled:opacity-50 disabled:bg-gray-100 disabled:cursor-not-allowed" type="number" step="0.01" name="price"
                                        :value="old('price')" placeholder="0.00" ::disabled="priceOnRequest" ::value="priceOnRequest ? '' : $el.value" />
                                </div>
                                <p class="text-xs text-gray-500 mt-2 ml-1" x-show="!priceOnRequest">Unesite iznos u eurima.</p>
                                <p class="text-xs text-primary-600 mt-2 ml-1 font-medium" x-show="priceOnRequest" style="display: none;">Kupci će vas kontaktirati za cijenu.</p>
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>

                            <!-- Duration -->
                            <div>
                                <x-input-label for="duration_days" :value="__('Trajanje oglasa')" class="text-lg font-semibold text-gray-700" />
                                <div class="relative mt-2">
                                    <select id="duration_days" name="duration_days" class="block w-full p-4 border-gray-200 focus:border-primary-500 focus:ring-primary-500 rounded-xl shadow-sm bg-gray-50 appearance-none">
                                        <option value="7">7 dana</option>
                                        <option value="14">14 dana</option>
                                        <option value="30">30 dana</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('duration_days')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Detaljan opis')" class="text-lg font-semibold text-gray-700" />
                            <textarea id="description" name="description" rows="8" class="block mt-2 w-full p-4 border-gray-200 focus:border-primary-500 focus:ring-primary-500 rounded-xl shadow-sm bg-gray-50" placeholder="Opišite detaljno što nudite ili tražite..." required>{{ old('description') }}</textarea>
                            <p class="mt-2 text-sm text-gray-500">
                                Podržan je <a href="https://www.markdownguide.org/basic-syntax/" target="_blank" class="text-primary-600 hover:text-primary-700 underline">Markdown format</a> za stiliziranje teksta (podebljano, liste, itd.).
                            </p>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Images Upload -->
                        <div x-data="imageUploader()" x-ref="uploaderContainer">
                            <x-input-label :value="__('Fotografije')" class="text-lg font-semibold text-gray-700" />
                            <p class="text-sm text-gray-500 mt-1 mb-3">Dodajte do 5 fotografija. Prva fotografija će biti naslovna.</p>

                            <!-- Hidden inputs for uploaded image URLs -->
                            <template x-for="(image, index) in uploadedImages" :key="'uploaded-' + index">
                                <input type="hidden" name="uploaded_images[]" :value="image.url">
                            </template>

                            <div class="mt-2">
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary-400 transition-colors cursor-pointer bg-gray-50" x-show="uploadedImages.length < 5" @click="$refs.fileInput.click()" @dragover.prevent="dragover = true"
                                    @dragleave.prevent="dragover = false" @drop.prevent="handleDrop($event)" :class="{ 'border-primary-500 bg-primary-50': dragover, 'opacity-50 cursor-not-allowed': uploading }">
                                    <input type="file" multiple accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="hidden" x-ref="fileInput" @change="handleFiles($event)" :disabled="uploading">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">
                                        <span class="font-medium text-primary-600">Kliknite za odabir</span> ili povucite fotografije ovdje
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF, WEBP do 5MB</p>
                                </div>

                                <!-- Upload Progress -->
                                <div x-show="uploading" class="mt-4 p-4 bg-blue-50 rounded-xl">
                                    <div class="flex items-center gap-3">
                                        <svg class="animate-spin h-5 w-5 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-primary-700">Učitavanje fotografija... <span x-text="uploadProgress"></span>%</span>
                                    </div>
                                    <div class="mt-2 w-full bg-blue-200 rounded-full h-2">
                                        <div class="bg-primary-600 h-2 rounded-full transition-all duration-300" :style="'width: ' + uploadProgress + '%'"></div>
                                    </div>
                                </div>

                                <!-- Image Previews -->
                                <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4" x-show="uploadedImages.length > 0">
                                    <template x-for="(image, index) in uploadedImages" :key="'img-' + index">
                                        <div class="relative group aspect-square">
                                            <img :src="image.url" class="w-full h-full object-cover rounded-lg border border-gray-200">
                                            <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                                <button type="button" @click="removeImage(index)" class="p-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <span x-show="index === 0" class="absolute top-2 left-2 px-2 py-1 bg-primary-500 text-white text-xs font-medium rounded">Naslovna</span>
                                        </div>
                                    </template>
                                </div>

                                <!-- Error Message -->
                                <div x-show="uploadError" class="mt-4 p-3 bg-red-50 text-red-700 rounded-lg text-sm" x-text="uploadError"></div>
                            </div>
                            <x-input-error :messages="$errors->get('uploaded_images')" class="mt-2" />
                        </div>

                        <!-- Anonymous Option -->
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-200">
                            <input id="is_anonymous" name="is_anonymous" type="checkbox" value="1" class="h-5 w-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded transition duration-150 ease-in-out">
                            <div class="ml-3">
                                <label for="is_anonymous" class="font-medium text-gray-900 cursor-pointer">Objavi anonimno</label>
                                <p class="text-sm text-gray-500">Vaše ime i prezime neće biti vidljivo javnosti. Korisnici će vas moći kontaktirati samo putem platforme ako ne ostavite druge podatke.</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end pt-6 border-t border-gray-100">
                            <x-primary-button class="px-8 py-3 text-lg rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                                {{ __('Objavi oglas') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function imageUploader() {
            return {
                dragover: false,
                uploadedImages: [],
                uploading: false,
                uploadProgress: 0,
                uploadError: null,

                handleFiles(event) {
                    const newFiles = Array.from(event.target.files);
                    this.uploadFiles(newFiles);
                    event.target.value = '';
                },

                handleDrop(event) {
                    this.dragover = false;
                    const newFiles = Array.from(event.dataTransfer.files).filter(f => f.type.startsWith('image/'));
                    this.uploadFiles(newFiles);
                },

                async uploadFiles(files) {
                    const remaining = 5 - this.uploadedImages.length;
                    const filesToUpload = files.slice(0, remaining);

                    if (filesToUpload.length === 0) return;

                    this.uploading = true;
                    this.uploadError = null;
                    this.uploadProgress = 0;

                    const totalFiles = filesToUpload.length;
                    let completedFiles = 0;

                    for (const file of filesToUpload) {
                        try {
                            // Get signed URL from server
                            const signedResponse = await fetch('{{ route('upload.signed-url') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({
                                    filename: file.name,
                                    content_type: file.type,
                                }),
                            });

                            if (!signedResponse.ok) {
                                throw new Error('Greška pri dobivanju URL-a za upload');
                            }

                            const {
                                url,
                                public_url
                            } = await signedResponse.json();

                            // Upload directly to DigitalOcean Spaces
                            const uploadResponse = await fetch(url, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': file.type,
                                    'x-amz-acl': 'public-read',
                                },
                                body: file,
                            });

                            if (!uploadResponse.ok) {
                                throw new Error('Greška pri učitavanju fotografije');
                            }

                            this.uploadedImages.push({
                                url: public_url
                            });
                            completedFiles++;
                            this.uploadProgress = Math.round((completedFiles / totalFiles) * 100);

                        } catch (error) {
                            console.error('Upload error:', error);
                            this.uploadError = error.message || 'Greška pri učitavanju fotografije';
                        }
                    }

                    this.uploading = false;
                },

                removeImage(index) {
                    this.uploadedImages.splice(index, 1);
                }
            }
        }
    </script>
</x-app-layout>
