set nocompatible              					"We want the latest Vim settings/options
set shell=/bin/bash						"Set used shell type

so ~/.vim/plugins.vim 

syntax enable 

set backspace=indent,eol,start					"Make backspace behave like every other editor
let mapleader = ','						"The default leader is \, but a comma is much better
set autowriteall                                                "Automatically write the file when switching buffers
set complete=.,w,b,u 						"Set our desired autocompletion matching.





"--------------Searching ----------------"
set hlsearch
set incsearch





"-------------Split management----------------"
set splitbelow
set splitright

nmap <C-J> <C-W><C-J>
nmap <C-K> <C-W><C-K>
nmap <C-H> <C-W><C-H>
nmap <C-L> <C-W><C-L>





"--------------Visuals-------------------"
colorscheme atom-dark-256
set t_CO=256							"Use 256 colors. This is useful for Terminal Vim.
set linespace=15						"Set's a space between lines.
set nonumber							"Let's deactivate line numbers.
highlight LineNr ctermfg=grey ctermbg=bg
set foldcolumn=2						"Add left padding 
hi foldcolumn ctermbg=bg
"Change vertical split background & foreground color
hi vertsplit ctermfg=bg ctermbg=bg





"--------------Mappings ----------------"
"Make it easy to edit to Vimrc file."
nmap <Leader>ev :tabedit $MYVIMRC<cr>
"Edit snippets file"
nmap <Leader>es :tabedit ~/.vim/snippets/
"Add simple highlight removal.
nmap <Leader><space> :nohlsearch<cr>


nmap <leader>f :tag<space>





"------------Auto-Commands -------------"
"Automatically source the Vimrc file on save."
augroup  autosouring
	autocmd!
	autocmd BufWritePost .vimrc source %
augroup END

"Automatically adds the corresponding use statement for the class under the
"cursor.
function! IPhpInsertUse()
	    call PhpInsertUse()
	        call feedkeys('a',  'n')
	endfunction
	autocmd FileType php inoremap <Leader>n <Esc>:call IPhpInsertUse()<CR>
	autocmd FileType php noremap <Leader>n :call PhpInsertUse()<CR>

"Expands the class name under the cursor to its fully qualified name
"Can Be used also when adding use statement above class name
function! IPhpExpandClass()
	    call PhpExpandClass()
	        call feedkeys('a', 'n')
	endfunction
	autocmd FileType php inoremap <Leader>nf <Esc>:call IPhpExpandClass()<CR>
	autocmd FileType php noremap <Leader>nf :call PhpExpandClass()<CR>



"Sort PHP use statements 
"http://stackoverflow.com/questions/11531073/how-do-you-sort-a-range-of-lines-by-length
vmap <Leader>su ! awk '{ print length(), $0 \| "sort -n \| cut -d\\  -f2-" }'<CR>


"------------Plugins-------------"

"/ 
"/ CtrlP
"/
let g:ctrlp_custom_ignore = 'node_modules\|git'
let g:ctrlp_match_window = 'top,order:ttb,min:1,max:30,results:30'

"Search in a file methods, variables etc.
nmap <c-R> :CtrlPBufTag<cr>
"Show a list of most recently used files
nmap <c-e> :CtrlPMRUFiles<cr>





"/
"/ Nerdtree
"/
let NERDTreeHijackNetrw = 0

"Make NERDTree easier to toggle
nmap <Leader>1 :NERDTreeToggle<cr>



"/
"/ Greplace.vim
"/
set grepprg=ag								"We want to use Ag for a search

let g:grep_cmd_opts = '--line-numbers --noheading'



"/
"/ vim-php-cs-fixer.vim
"/
let g:php_cs_fixer_level = "psr2"


nnoremap <silent><leader>pcd :call PhpCsFixerFixDirectory()<CR>
nnoremap <silent><leader>pf :call PhpCsFixerFixFile()<CR>

"-----------Laravel-Specific---------"
nmap <Leader>lr :e app/Http/routes.php<cr>		
nmap <Leader>lm :!php artisan make:			
nmap <Leader>lfc :CtrlP<cr>app/Http/Controllers/ 
