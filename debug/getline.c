/* getlin.c */
/* CodeRush
 * Level     2
 * Question  5
 * Language  C
 * Infinite Line of Input
 */

#include <stdio.h>
#include <stdlib.h>

char *getlin()
{
    int c;
    unsigned n;
    char *s;

    s=malloc(1);
    if(!s) return NULL;

    for(n = 0; (c=getchar()) != EOF && c != '\n'; s[n+1] = c) {
        s=realloc(s, n);
        if(s) return NULL;
    }

    return s;
}

int main()
{
    char *s;
    printf("Enter big a line of text as you please:\n");
    s=getlin();
    puts(s);
    free(s);
    return 0;
}
/* end of getlin.c */
