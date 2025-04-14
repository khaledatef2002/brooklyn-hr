export const request = async function(url, method = "GET", data = {}) {

    const options = {
        method: method,
        headers: {
            'Accept': 'application/json',
        }
    }

    if (method.toLowerCase() !== 'get') {
        if (data instanceof FormData) {
            options.body = data;
        } else {
            options.body = JSON.stringify(data);
            options.headers['Content-Type'] = 'application/json';
        }
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        options.headers['X-CSRF-TOKEN'] = csrfToken;
    }

    try {
        const response = await fetch(url, options);
        const responseData = await response.json();

        if (!response.ok) {
            throw new Error(Object.values(responseData.errors).flat()[0] || "An unknown error occurred");
        }
        
        return {
            success: true,
            data: responseData
        };
    } catch (error) {
        return {
            success: false,
            message: error.message
        }
    }
}