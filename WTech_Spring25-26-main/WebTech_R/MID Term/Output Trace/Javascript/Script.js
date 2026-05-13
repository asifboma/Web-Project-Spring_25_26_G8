
let str = "Hello, World!";
let name = "123456789";

// Basic Operations
console.log(str.length);                    // 13
console.log(str.toUpperCase());             // "HELLO, WORLD!"
console.log(str.toLowerCase());             // "hello, world!"
console.log(str.charAt(1));                  // "e"
console.log(str.indexOf("Hello"));           // 7
console.log(str.includes("hello"));          // false

// String Manipulation
console.log(str.substring(0, 7));            // "Hello,"
console.log(str.slice(7, 12));               // "World"
console.log(str.replace("World", "JavaScript")); // "Hello, JavaScript!"
console.log(str.split(" , "));                 // ["Hello", "World!"]
console.log("trim me".trim());          // "trim me"
console.log(name.padStart(13, "+880"));      
console.log(name.repeat(3));                  // "JohnJohnJohn"

//Mid MCQ = 20 * 1.5 = 30
// Output Tracing 2 * 5  = 10
// Code Writting 1* 20 = 20
//-------------------------------
//Total = 60