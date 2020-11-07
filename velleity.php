<?php
$title = "Velleity";
require "php/top.php";
?>
<main>
  <article>
    <header>
      <h1>Velleity</h1>
      <h2>CSS Framework</h2>
      <h3>Inline Text Semantics</h3>
    </header>
    <p>What is Velleity?</p>
    <p>Velleity is a front-end framework used to build this website and all associated applications.</p>
    <br>
    <p>Lorem ipsum dolor sit amet. <a href="#">This is hyperlink</a>. Consectetur adipisicing elit, sed do eiusmod. <abbr title="This is an abbreviation">TIAA</abbr>. Tempor incididunt ut labore et dolore magna aliqua. <code>Code snippet</code>. Ut enim ad minim. <em>emphasised text</em>. Veniam, quis nostrud. <kbd>Control</kbd> & <kbd>B</kbd>. Exercitation ullamco laboris. <i>italic text</i>. Nisi ut aliquip ex ea. <s>This is a strike</s>. Commodo consequat. <samp>This is a sample output</samp>. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu. <time>This is a time</time>. Fugiat nulla pariatur. <sup>Superscript</sup> and <sub>subscript</sub>. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia. <del>This is deleted</del> and <ins>this is inserted</ins>. Deserunt mollit. This is a <var>variable</var>. Anim id est laborum. <mark>This is a mark</mark>.</p>
  </article>


  <article>
    <p>Lists can be numbered or unnumbered.</p>
    <h2>List Types</h2>
    <ol class="col-6">
      <li>List Item</li>
      <li>List Item</li>
      <li>List Item</li>
      <li>List Item</li>
    </ol>
    <ul class="col-6">
      <li>List Item</li>
      <li>List Item</li>
      <li>List Item</li>
      <li>List Item</li>
    </ul>
    <h2>Descriptive List</h2>
    <dl class="col-12">
      <dt>Descriptive Term</dt>
      <dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
        irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</dd>
      <dt>Descriptive Term</dt>
      <dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</dd>
    </dl>
    <h2>Details</h2>
    <details class="col-12" open>
      <summary>This element is for details, click to toggle close/open.</summary>
      <p>This text should be shown if the details element is opened.</p>
    </details>
    <h2>Code</h2>
    <code>var number = 1;
      </code>
    <h2>Address</h2>
    <address>UK, England, Merseyside, Prescot, Lyneham</address>
  </article>



  <section>

    <h3>Quotes</h3>
    <blockquote cite="https://www.goodreads.com/quotes/144310-the-nitrogen-in-our-dna-the-calcium-in-our-teeth">The nitrogen in our DNA, the calcium in our teeth, the iron in our blood, the carbon in our apple pies were made in the interiors of collapsing stars. We are made of starstuff.</blockquote>
    <cite>This is a citation.</cite>
    <q cite="http://reddit.com">This is quote.</q>

    <h3>Directions</h3>
    <details open>
      <summary>details summary</summary>
      <p>This is a paragraph in a details.</p>
    </details>
    <p>This is a meter.</p>
    <meter value="50" min="0" max="100"></meter>
    <p>This is a progress.</p>
    <progress value="50" max="100">50%</progress>
    <h3>Media</h3>
    <audio controls>
      <source src="" type="audio/ogg"/>
      <source src="" type="audio/mpeg"/>
    </audio>
    <video style="width: 50%;" poster="https://horsevets.co.uk/wp-content/uploads/2013/10/placeholder.jpg" controls>
      <source src="C:\Users\Scott\Downloads\MOV_0270.mp4" type="video/mp4"/>
    </video>
    <h3>Images</h3>
    <figure>
      <figcaption>This is a figure caption in a figure.</figcaption>
      <img src="https://horsevets.co.uk/wp-content/uploads/2013/10/placeholder.jpg" alt="Placeholder"/>
    </figure>
    <img src="https://horsevets.co.uk/wp-content/uploads/2013/10/placeholder.jpg" alt="Planets" usemap="#planetmap">
    <map name="planetmap">
      <area shape="rect" coords="0,0,82,126" alt="Sun" href="sun.htm">
      <area shape="circle" coords="90,58,3" alt="Mercury" href="mercur.htm">
      <area shape="circle" coords="124,58,8" alt="Venus" href="venus.htm">
    </map>
    <picture>
      <source media="(min-width: 650px)" srcset="https://horsevets.co.uk/wp-content/uploads/2013/10/placeholder.jpg" width="150" height="250"/>
      <source media="(min-width: 465px)" srcset="placeholder.png" width="150" height="150"/>
      <img src="placeholder.png" alt="Flowers" width="150" height="150"/>
    </picture>
    <svg>
      <circle cx="50" cy="50" r="40" stroke="green" stroke-width="4" fill="yellow" />
      <rect width="400" height="100" style="fill:rgb(0,0,255);stroke-width:10;stroke:rgb(0,0,0)" />
      <rect x="50" y="20" rx="20" ry="20" width="150" height="150" style="fill:red;stroke:black;stroke-width:5;opacity:0.5" />
      <polygon points="100,10 40,198 190,78 10,78 160,198" style="fill:lime;stroke:purple;stroke-width:5;fill-rule:evenodd;"/>
      <defs>
        <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
          <stop offset="0%" style="stop-color:rgb(255,255,0);stop-opacity:1"/>
          <stop offset="100%" style="stop-color:rgb(255,0,0);stop-opacity:1"/>
        </linearGradient>
      </defs>
      <ellipse cx="100" cy="70" rx="85" ry="55" fill="url(#grad1)"/>
      <text fill="#ffffff" font-size="45" font-family="Verdana" x="50" y="86">SVG</text>
      Sorry, your browser does not support inline SVG.
    </svg>
  </section>

  <section>
    <header>
      <h2>Forms</h2>
      <h3>Get</h3>
    </header>
    <p>Comments from 22918078 should be rendered beneath here. Put and delete xhr request functions should be appended to respective comments.</p>
    <h3>Post</h3>
    <form action="http://teaching.ehustudent.co.uk/add-my-comment/22918078" method="post">
      <fieldset>
        <div class="">
          <label for="studentnr">Student Number: </label>
          <input type="number" name="studentnr" placeholder="22918078" />
        </div>
        <div class="">
          <label for="name">Name: </label>
          <input type="text" name="name" placeholder="Jack Smith" />
        </div>
        <div class="">
          <label for="email">Email: </label>
          <input type="email" name="email" placeholder="name@example.com" />
        </div>
        <div class="">
          <label for="comment">Comment: </label>
          <textarea name="comment"></textarea>
        </div>
        <button type="submit" name="submit">Post</button>
      </fieldset>
    </form>
    <h3>Template</h3>
    <form action="index.php" method="post">
      <fieldset>
        <legend>This is a legend</legend>
        <div>
          <label for="checkbox">Checkbox</label>
          <input type="checkbox" name="checkbox" value="This is a checkbox."/>
        </div>
        <div>
          <label for="colour">Colour</label>
          <input type="color" name="colour" value="#999999"/>
        </div>
        <div>
          <label for="date">Date</label>
          <input type="date" name="date" value="2019-11-21"/>
        </div>
        <div>
          <label for="datetime-local">Datetime-local</label>
          <input type="datetime-local" name="datetime-local" placeholder=""/>
        </div>
        <div>
          <label for="email">Email</label>
          <input type="email" name="email" placeholder="example@example.com"/>
        </div>
        <div>
          <label for="file">File</label>
          <input type="file" name="file" placeholder=""/>
        </div>
        <div>
          <label for="month">Month</label>
          <input type="month" name="month" placeholder=""/>
        </div>
        <div>
          <label for="number">Number</label>
          <input type="number" name="number" placeholder="42"/>
        </div>
        <div>
          <label for="password">Password</label>
          <input type="password" name="password" placeholder="Password2019"/>
        </div>
        <div>
          <label for="range">Range</label>
          <input type="range" name="range" placeholder=""/>
        </div>
        <div>
          <label for="radio">Radio</label>
          <input type="radio" name="radio" placeholder=""/>
        </div>
        <div>
          <label for="search">Search</label>
          <input type="search" name="search" placeholder="Search..."/>
        </div>
        <div>
          <label for="text">Text</label>
          <input type="text" name="text" placeholder="Text..."/>
        </div>
        <div>
          <label for="time">Time</label>
          <input type="time" name="time" value=""/>
        </div>
        <div>
          <label for="url">URL</label>
          <input type="url" name="url" placeholder="www.google.co.uk/"/>
        </div>
        <div>
          <label for="week">Week</label>
          <input type="week" name="week" placeholder=""/>
        </div>
        <div>
          <label for="browsers">Browsers</label>
          <input name="browsers" list="browsers">
        </div>
        <datalist id="browsers">
          <option value="Internet Explorer">
          <option value="Firefox">
          <option value="Chrome">
          <option value="Opera">
          <option value="Safari">
        </datalist>
        <div>
          <label for="textarea">Textarea</label>
          <textarea name="textarea" rows="8" cols="80" placeholder="Write something..."></textarea>
        </div>
        <div>
          <label for="select">Select</label>
          <select name="select">
            <optgroup label="A">
              <option value="1">This is an option.</option>
              <option value="2">This is an option.</option>
            </optgroup>
            <optgroup label="B">
              <option value="1">This is an option.</option>
              <option value="2">This is an option.</option>
            </optgroup>
          </select>
        </div>
        <input type="button" name="button" value="This is a button"/>
        <input type="reset" name="reset" value="Reset Form"/>
        <input type="submit" name="submit" value="Submit" disabled/>
      </fieldset>
      <output name="output">This is an output.</output>
    </form>
  </section>
  <section id='lists'>
    <header>
      <h2>Lists</h2>
      <h3>Ordered List</h3>
    </header>
    <ol>
      <li><data value="000033">This is a data in a list item.</data></li>
      <li>This is another list item.</li>
    </ol>
    <h3>Unordered List</h3>
    <ul>
      <li>This is a list item.</li>
      <li>This is another list item.</li>
    </ul>
    <h3>Descriptive List</h3>
    <dl>
      <dt>This is a descriptive term in a descriptive list.</dt>
      <dd>This is a descriptive defenition.</dd>
    </dl>
  </section>
  <section id="tables">
    <h2>Tables</h2>
    <p>Data can be organsided into tables.</p>
    <table>
      <caption>This is a table caption.</caption>
      <thead>
        <tr>
          <th>This is a table heading in a table row.</th>
          <th>This is a table heading.</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>This is a table data.</td>
          <td>This is another table data.</td>
        </tr>
        <tr>
          <td>This is a table data.</td>
          <td>This is another table data.</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td>This is a table data.</td>
          <td>This is another table data.</td>
        </tr>
      </tfoot>
    </table>
  </section>
  <article id='javascript-functions'>
    <header>
      <h2>JavaScript Functions</h2>
      <h3>Accordion</h3>
    </header>
    <div class="accordion">
      <p>Acc 1</p>
      <div>
        <p>Content 1.</p>
      </div>
      <p>Acc 2</p>
      <div>
        <p>Content 2.</p>
      </div>
    </div>
    <h3>Slideshow</h3>
    <div class="slideshow">
      <figure>
        <figcaption>This is a figure caption</figcaption>
        <img src="https://cdn.mos.cms.futurecdn.net/ZGi6eSYZrmgbBLAuJQXvhb-1200-80.jpg" alt="Batman: The Animated Series">
        <img src="https://www.animationconnection.com/assets/artwork/1534965514-395-1010-top-cat-model-sheet.jpg" alt="Top Cat">
      </figure>
    </div>
    <h3>Tabs</h3>
    <div class="tabs">
      <ul>
        <li>Tab 1</li>
        <li>Tab 2</li>
      </ul>
      <div>
        <p>Content 1.</p>
      </div>
      <div>
        <p>Content 2.</p>
      </div>
    </div>
  </article>
  <article>
    <h1 class="col-12">Media</h1>
    <p class="col-12">Below is an audio file. HTML supports MP3, OGG, and WAV.</p>
    <audio class="col-12" src="media/audio/typewriter.mp3" controls></audio>
    <p class="col-12">Captions can be overlayed onto pictures or shown below.</p>
    <video class="col-12" src="media/video/mad-love.mp4" controls></video>
    <p class="col-12">Captions can be overlayed onto pictures or shown below.</p>
    <figure class="col-6">
      <img src="media/img/land.jpg" alt="temp" />
      <figcaption class="outside">This caption is outside.</figcaption>
    </figure>
    <figure class="col-6">
      <img src="media/img/land.jpg" alt="temp" />
      <figcaption class="inside">This caption is inside.</figcaption>
    </figure>
    <p class="col-12">This is an automatic slideshow. It will be updated to support:</p>
    <ul class="col-12">
      <li>Preview each slide via thumbnail</li>
      <li>Manually select slide (requires above)</li>
      <li>Set custom speed or disable</li>
    </ul>
    <figure class="slideshow">
      <img src="media/img/land.jpg" alt="temp" />
      <img src="media/img/port.jpg" alt="temp" />
      <img src="media/img/by.jpg" alt="temp" />
      <img src="media/img/land-2.jpg" alt="temp" />
      <div class="progress"></div>
      </div>
      <div class="controller-ss"></div>
    </figure>
    <p class="col-12">Progres shows a value between minimum and value. This is used to show class record.</p>
    <progress value="50" max="100">50%</progress>
  </article>
</main>
<?php require "php/bottom.php"; ?>
<!--
  https://developer.spotify.com/documentation/web-api/
-->
