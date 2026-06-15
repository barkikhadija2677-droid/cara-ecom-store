@extends('layouts.app')
@section('title', 'Custom Shirt Builder')

@section('styles')
<style>
    :root {
        --primary-green: #088178;
        --primary-dark: #1a1a1a;
        --panel-bg: #ffffff;
        --card-bg: #f5f7f8;
        --text-dark: #222222;
        --text-muted: #475569;
        --border-color: #e2e8f0;
    }

    /* Builder Layout */
    .builder-container {
        display: flex;
        flex-wrap: wrap;
        min-height: 80vh;
        background: var(--panel-bg);
        color: var(--text-dark);
        font-family: 'Inter', sans-serif;
    }

    .preview-panel {
        flex: 1;
        min-width: 300px;
        background: var(--panel-bg);
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 40px;
        position: sticky;
        top: 20px;
    }

    .preview-card {
        background: var(--card-bg);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        padding: 40px;
        width: 100%;
        max-width: 500px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    .controls-panel {
        flex: 1;
        min-width: 350px;
        padding: 40px;
        max-width: 500px;
    }

    /* Shirt Preview & Overlays */
    .shirt-wrapper {
        position: relative;
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
        isolation: isolate;
    }

    .shirt-base {
        width: 100%;
        display: block;
        position: relative;
        z-index: 1;
    }



    .overlay-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 3;
    }

    /* Overlay Positioning Classes */
    .pos-chest-center {
        position: absolute;
        top: 35%;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 25%;
        max-width: 120px;
    }

    .pos-top-mid {
        position: absolute;
        top: 26%;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 25%;
        max-width: 120px;
    }

    .pos-left-chest {
        position: absolute;
        top: 35%;
        left: 65%; /* Wearer's left chest on front view */
        transform: translateX(-50%) scale(0.5);
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 25%;
        max-width: 120px;
    }

    .graphic-layer i {
        font-size: 48px;
        color: #333;
        transition: all 0.3s ease;
        opacity: 0.9;
    }

    .text-layer {
        margin-top: 10px;
        font-size: 16px;
        font-weight: 800;
        color: #333;
        text-transform: uppercase;
        text-align: center;
        letter-spacing: 1px;
        word-break: break-word;
        width: 100%;
    }

    /* Dynamic Contrast for Dark Shirts */
    .dark-shirt-mode .graphic-layer i,
    .dark-shirt-mode .text-layer {
        color: #f1f1f1;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }

    /* Controls Styling */
    .controls-panel h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
        color: var(--text-dark);
    }

    .controls-panel .price {
        font-size: 24px;
        font-weight: 600;
        color: var(--primary-green);
        margin-bottom: 40px;
    }

    .control-group {
        margin-bottom: 30px;
    }

    .control-group h3 {
        font-size: 16px;
        color: var(--text-muted);
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Colors Grid */
    .color-options {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .color-btn {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 2px solid var(--border-color);
        cursor: pointer;
        transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
    }

    .color-btn.active {
        border: 3px solid var(--primary-green);
        outline: 2px solid white;
        transform: scale(1.15);
        box-shadow: 0 4px 10px rgba(8, 129, 120, 0.3);
    }
    
    /* White Color Btn specific styling for visibility */
    .color-btn[data-color="transparent"] {
        background: #ffffff;
    }

    /* Graphic Cards */
    .graphic-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
        gap: 15px;
    }

    .graphic-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        padding: 15px 10px;
        border-radius: 12px;
        cursor: pointer;
        text-align: center;
        transition: all 0.2s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }

    .graphic-card.active {
        border-color: var(--primary-green);
        background: rgba(8, 129, 120, 0.05);
    }

    .graphic-card i {
        font-size: 24px;
        margin-bottom: 8px;
        color: var(--primary-dark);
    }

    .graphic-card span {
        display: block;
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 600;
    }

    /* Forms */
    .form-control {
        width: 100%;
        padding: 14px 16px;
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        color: var(--text-dark);
        font-size: 16px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-green);
    }

    .btn-add-cart {
        width: 100%;
        padding: 18px;
        background: var(--primary-green);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
        margin-top: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-add-cart:hover {
        background: #06665f;
        transform: translateY(-2px);
    }
</style>
@endsection

@section('content')
<div class="builder-container">
    
    <!-- Left Panel: Preview Mockup -->
    <div class="preview-panel">
        <div class="preview-card">
            <div class="shirt-wrapper" id="shirt-wrapper">
                <!-- Base Image -->
                <img src="{{ asset('img/products/plain-white-shirt.png') }}" class="shirt-base" alt="Plain Shirt">
                
                <!-- Graphics & Text Overlays -->
                <div class="overlay-container pos-chest-center" id="overlay-container">
                    <div class="graphic-layer" id="graphic-layer"></div>
                    <div class="text-layer" id="text-layer"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right Panel: Controls Menu -->
    <div class="controls-panel">
        <h1>Custom Shirt Builder</h1>
        <div class="price">$25.00</div>
        
        <!-- 1. Color Palette -->
        <div class="control-group">
            <h3>1. Base Color</h3>
            <div class="color-options">
                <div class="color-btn active" data-color="transparent" data-name="White" data-dark="false" title="White"></div>
                <div class="color-btn" data-color="#1a1a1a" data-name="Jet Black" data-dark="true" style="background: #1a1a1a;" title="Jet Black"></div>
                <div class="color-btn" data-color="#7a1c1c" data-name="Crimson Maroon" data-dark="true" style="background: #7a1c1c;" title="Crimson Maroon"></div>
                <div class="color-btn" data-color="#1d3557" data-name="Classic Navy Blue" data-dark="true" style="background: #1d3557;" title="Classic Navy Blue"></div>
                <div class="color-btn" data-color="#1b4332" data-name="Forest Green" data-dark="true" style="background: #1b4332;" title="Forest Green"></div>
                <div class="color-btn" data-color="#e0aaff" data-name="Soft Lavender" data-dark="false" style="background: #e0aaff;" title="Soft Lavender"></div>
                <div class="color-btn" data-color="#e9c46a" data-name="Mustard Yellow" data-dark="false" style="background: #e9c46a;" title="Mustard Yellow"></div>
                <div class="color-btn" data-color="#606c38" data-name="Earthy Olive" data-dark="true" style="background: #606c38;" title="Earthy Olive"></div>
                <div class="color-btn" data-color="#4a4a4a" data-name="Charcoal Gray" data-dark="true" style="background: #4a4a4a;" title="Charcoal Gray"></div>
                <div class="color-btn" data-color="#4c1d95" data-name="Royal Purple" data-dark="true" style="background: #4c1d95;" title="Royal Purple"></div>
                <div class="color-btn" data-color="#f87171" data-name="Coral Red" data-dark="false" style="background: #f87171;" title="Coral Red"></div>
                <div class="color-btn" data-color="#065f46" data-name="Emerald Green" data-dark="true" style="background: #065f46;" title="Emerald Green"></div>
            </div>
        </div>
        
        <!-- 2. Graphic Design -->
        <div class="control-group">
            <h3>2. Graphic Design</h3>
            <div class="graphic-options">
                <div class="graphic-card active" data-graphic="None" data-icon="" data-pos="pos-chest-center">
                    <i class="fas fa-ban"></i>
                    <span>None</span>
                </div>
                <div class="graphic-card" data-graphic="Anime Vector" data-icon="fas fa-dragon" data-pos="pos-chest-center">
                    <i class="fas fa-dragon"></i>
                    <span>Anime Vector</span>
                </div>
                <div class="graphic-card" data-graphic="Vintage Retro" data-icon="fas fa-motorcycle" data-pos="pos-chest-center">
                    <i class="fas fa-motorcycle"></i>
                    <span>Vintage Retro</span>
                </div>
                <div class="graphic-card" data-graphic="Cyberpunk Neon" data-icon="fas fa-network-wired" data-pos="pos-chest-center">
                    <i class="fas fa-network-wired"></i>
                    <span>Cyberpunk</span>
                </div>
                <div class="graphic-card" data-graphic="Floral Blossom" data-icon="fas fa-seedling" data-pos="pos-chest-center">
                    <i class="fas fa-seedling"></i>
                    <span>Floral</span>
                </div>
                <div class="graphic-card" data-graphic="Minimal Crest" data-icon="fas fa-crown" data-pos="pos-top-mid">
                    <i class="fas fa-crown"></i>
                    <span>Minimal Crest</span>
                </div>
                <div class="graphic-card" data-graphic="Streetwear Box" data-icon="fas fa-square" data-pos="pos-chest-center">
                    <i class="fas fa-square"></i>
                    <span>Street Box</span>
                </div>
            </div>
        </div>
        
        <!-- 3. Custom Text -->
        <div class="control-group">
            <h3>3. Custom Name/Text</h3>
            <input type="text" id="custom-text-input" class="form-control" placeholder="Type Your Custom Name/Text" maxlength="15">
        </div>
        
        <!-- 4. Size Selection -->
        <div class="control-group">
            <h3>4. Size</h3>
            <select id="size-select" class="form-control">
                <option value="S">Small (S)</option>
                <option value="M" selected>Medium (M)</option>
                <option value="L">Large (L)</option>
                <option value="XL">Extra Large (XL)</option>
                <option value="XXL">Double XL (XXL)</option>
            </select>
        </div>
        
        <!-- Add to Cart -->
        <button id="add-to-cart-btn" class="btn-add-cart">
            <i class="fas fa-shopping-cart"></i> Add Custom Shirt to Cart
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const shirtWrapper = document.getElementById('shirt-wrapper');
    const overlayContainer = document.getElementById('overlay-container');
    const graphicLayer = document.getElementById('graphic-layer');
    const textLayer = document.getElementById('text-layer');
    const shirtBase = document.querySelector('.shirt-base');
    
    const colorBtns = document.querySelectorAll('.color-btn');
    const graphicCards = document.querySelectorAll('.graphic-card');
    const textInput = document.getElementById('custom-text-input');
    const sizeSelect = document.getElementById('size-select');
    const addToCartBtn = document.getElementById('add-to-cart-btn');
    
    // State Tracking
    let state = {
        colorName: 'White',
        colorHex: 'transparent',
        isDark: false,
        graphicName: 'None',
        graphicIcon: '',
        graphicPos: 'pos-chest-center',
        text: '',
        size: 'M'
    };

    // 1. Color Swatch Click Event
    colorBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // UI Toggle
            colorBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Update State
            state.colorHex = this.getAttribute('data-color');
            state.colorName = this.getAttribute('data-name');
            state.isDark = this.getAttribute('data-dark') === 'true';
            
        });
    });

    // 2. Graphic Card Click Event
    graphicCards.forEach(card => {
        card.addEventListener('click', function() {
            // UI Toggle
            graphicCards.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            
            // Update State
            state.graphicName = this.getAttribute('data-graphic');
            state.graphicIcon = this.getAttribute('data-icon');
            state.graphicPos = this.getAttribute('data-pos');
            
            // Apply Graphic
            if(state.graphicIcon) {
                graphicLayer.innerHTML = `<i class="${state.graphicIcon}"></i>`;
            } else {
                graphicLayer.innerHTML = '';
            }
            
            // Apply Positioning Class (Center vs Left Chest)
            overlayContainer.className = `overlay-container ${state.graphicPos}`;
        });
    });

    // 3. Live Text Input Event
    textInput.addEventListener('input', function() {
        state.text = this.value;
        textLayer.textContent = state.text;
    });

    // 4. Size Change Event
    sizeSelect.addEventListener('change', function() {
        state.size = this.value;
    });

    // 5. Submit to Cart
    addToCartBtn.addEventListener('click', function() {
        const payload = {
            color: state.colorName,
            graphic: state.graphicName,
            text: state.text,
            size: state.size,
            _token: '{{ csrf_token() }}'
        };
        
        const originalText = addToCartBtn.innerHTML;
        addToCartBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
        addToCartBtn.disabled = true;

        fetch('/custom-shirt/add-to-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert(data.message);
                // Optionally trigger a page refresh or clear form here
            } else {
                alert('Failed to add custom shirt.');
            }
        })
        .catch(err => {
            console.error('Error:', err);
            alert('An error occurred while adding to cart.');
        })
        .finally(() => {
            addToCartBtn.innerHTML = originalText;
            addToCartBtn.disabled = false;
        });
    });
});
</script>
@endsection
